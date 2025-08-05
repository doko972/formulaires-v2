<?php

namespace App\Http\Controllers;

use App\Models\WorkReception;
use App\Models\Material;
use App\Services\CityService;
use App\Mail\WorkReceptionValidated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class WorkReceptionController extends Controller
{
    /**
     * Affiche la liste des formulaires (dashboard).
     */
    public function index()
    {
        $workReceptions = WorkReception::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('work-reception.dashboard', compact('workReceptions'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        return view('work-reception.form');
    }

    /**
     * Affiche le formulaire d'édition.
     */
    public function edit(WorkReception $workReception)
    {
        // Vérifier que l'utilisateur connecté est propriétaire du formulaire
        if ($workReception->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        // Charger les cartes SIM et matériels liés
        $workReception->load('simCards', 'materials');

        return view('work-reception.form', compact('workReception'));
    }

    /**
     * Sauvegarde le formulaire (création ou modification).
     */
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            // Section 1: Informations générales
            'company_name' => 'nullable|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'acting_as' => 'nullable|string|max:255',
            
            // Section 2: Coordonnées
            'installation_address' => 'nullable|string',
            'postal_code' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:255',
            
            // Section 3: Description des travaux
            'work_description' => 'nullable|string',
            
            // Matériels (tableaux)
            'materials' => 'nullable|array',
            'materials.*.name' => 'nullable|string|max:255',
            'materials.*.type' => 'nullable|string|max:255',
            'materials.*.quantity' => 'nullable|integer|min:1',
            'materials.*.description' => 'nullable|string',
            
            // Section 4: Juridique
            'contract_reception_checked' => 'nullable|boolean',
            'contract_date' => 'nullable|date',
            'work_compliance_checked' => 'nullable|boolean',
            'electronic_location' => 'nullable|string|max:255',
            'signatory_name' => 'nullable|string|max:255',
            'client_signature' => 'nullable|string',
            'technician_name' => 'nullable|string|max:255',
            'technician_signature' => 'nullable|string',
            
            // Cartes SIM (tableaux)
            'sim_cards' => 'nullable|array',
            'sim_cards.*.option' => 'nullable|string|in:Backup,Routeur 4G,Téléphonie',
            'sim_cards.*.operator' => 'nullable|string|in:Free,Orange,Bouygues',
            'sim_cards.*.sim_number' => 'nullable|string|max:255',
        ]);

        // Ajouter l'ID de l'utilisateur connecté
        $validatedData['user_id'] = Auth::id();

        // Déterminer le statut (brouillon ou validation)
        $isValidation = !$request->has('save_draft');
        $validatedData['status'] = $isValidation ? 'validated' : 'draft';

        // Validation supplémentaire pour la validation finale
        if ($isValidation) {
            $additionalRules = [
                'contract_reception_checked' => 'required|accepted',
                'contract_date' => 'required|date',
                'work_compliance_checked' => 'required|accepted',
                'electronic_location' => 'required|string|max:255',
                'signatory_name' => 'required|string|max:255',
            ];

            $request->validate($additionalRules, [
                'contract_reception_checked.required' => 'Vous devez cocher la case de réception des travaux.',
                'contract_reception_checked.accepted' => 'Vous devez accepter la réception des travaux.',
                'contract_date.required' => 'La date du contrat est obligatoire pour la validation.',
                'work_compliance_checked.required' => 'Vous devez cocher la case de conformité des travaux.',
                'work_compliance_checked.accepted' => 'Vous devez confirmer la conformité des travaux.',
                'electronic_location.required' => 'Le lieu électronique est obligatoire pour la validation.',
                'signatory_name.required' => 'Le nom du signataire est obligatoire pour la validation.',
            ]);

            // Validation simplifiée pour la signature client
            if (empty($request->client_signature)) {
                return redirect()->back()
                    ->withErrors(['client_signature' => 'La signature du client est obligatoire pour la validation.'])
                    ->withInput();
            }
        }

        if ($request->has('work_reception_id') && $request->work_reception_id) {
            // Modification d'un formulaire existant
            $workReception = WorkReception::findOrFail($request->work_reception_id);
            
            // Vérifier que l'utilisateur connecté est propriétaire
            if ($workReception->user_id !== Auth::id()) {
                abort(403, 'Accès non autorisé.');
            }
            
            $workReception->update($validatedData);
            
            // Supprimer les anciennes cartes SIM et matériels, puis ajouter les nouveaux
            $workReception->simCards()->delete();
            $workReception->materials()->delete();
            
            $message = 'Formulaire mis à jour avec succès.';
        } else {
            // Création d'un nouveau formulaire
            $workReception = WorkReception::create($validatedData);
            $message = 'Formulaire créé avec succès.';
        }

        // Sauvegarder les cartes SIM
        if ($request->has('sim_cards') && is_array($request->sim_cards)) {
            foreach ($request->sim_cards as $simCardData) {
                // Ne sauvegarder que si au moins un champ est rempli
                if (!empty($simCardData['option']) || !empty($simCardData['operator']) || !empty($simCardData['sim_number'])) {
                    $workReception->simCards()->create([
                        'option' => $simCardData['option'] ?? null,
                        'operator' => $simCardData['operator'] ?? null,
                        'sim_number' => $simCardData['sim_number'] ?? null,
                    ]);
                }
            }
        }

        // Sauvegarder les matériels
        if ($request->has('materials') && is_array($request->materials)) {
            foreach ($request->materials as $materialData) {
                // Ne sauvegarder que si au moins un champ important est rempli
                if (!empty($materialData['name']) || !empty($materialData['type'])) {
                    $workReception->materials()->create([
                        'name' => $materialData['name'] ?? null,
                        'type' => $materialData['type'] ?? null,
                        'quantity' => $materialData['quantity'] ?? 1,
                        'description' => $materialData['description'] ?? null,
                    ]);
                }
            }
        }

        // Marquer comme validé avec timestamp si c'est une validation
        if ($isValidation) {
            $validatedData['validated_at'] = now();
            $workReception->markAsValidated();
            
            // Envoyer l'email avec le PDF
            try {
                Mail::to(Auth::user()->email)->send(new WorkReceptionValidated($workReception));
                $message .= ' Un email avec le PDF a été envoyé.';
            } catch (\Exception $e) {
                $message .= ' Attention: erreur lors de l\'envoi de l\'email.';
            }
        }

        return redirect()->route('work-reception.edit', $workReception)
            ->with('success', $message);
    }

    /**
     * Supprime un formulaire.
     */
    public function destroy(WorkReception $workReception)
    {
        // Vérifier que l'utilisateur connecté est propriétaire
        if ($workReception->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $workReception->delete();

        return redirect()->route('work-reception.index')
            ->with('success', 'Formulaire supprimé avec succès.');
    }

    /**
     * Récupère les villes pour un code postal via AJAX
     */
    public function getCities(string $postalCode)
    {
        $result = CityService::getCitiesByPostalCode($postalCode);
        
        return response()->json($result);
    }
}