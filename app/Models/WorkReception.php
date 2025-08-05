<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkReception extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     */
    protected $fillable = [
        // Section 1: Informations générales
        'company_name',
        'client_name',
        'acting_as',
        
        // Section 2: Coordonnées
        'installation_address',
        'postal_code',
        'city',
        
        // Section 3: Description des travaux
        'work_description',
        // Note: model et quantity sont maintenant dans la table materials
        
        // Section 4: Juridique
        'contract_reception_checked',
        'contract_date',
        'work_compliance_checked',
        'electronic_location',
        'signatory_name',
        'client_signature',
        'technician_name',
        'technician_signature',
        
        // Métadonnées
        'status',
        'user_id',
        'validated_at',
    ];

    /**
     * Les attributs qui doivent être castés.
     */
    protected $casts = [
        'contract_reception_checked' => 'boolean',
        'work_compliance_checked' => 'boolean',
        'contract_date' => 'date',
        'validated_at' => 'datetime',
        'quantity' => 'integer',
    ];

    /**
     * Relation avec l'utilisateur qui a créé le formulaire.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les cartes SIM.
     */
    public function simCards(): HasMany
    {
        return $this->hasMany(SimCard::class);
    }

    /**
     * Relation avec les matériels.
     */
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    /**
     * Vérifie si le formulaire est un brouillon.
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Vérifie si le formulaire est validé.
     */
    public function isValidated(): bool
    {
        return $this->status === 'validated';
    }

    /**
     * Marque le formulaire comme validé.
     */
    public function markAsValidated(): void
    {
        $this->update([
            'status' => 'validated',
            'validated_at' => now(),
        ]);
    }
}