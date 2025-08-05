<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class CityService 
{
    /**
     * URL de l'API Geo française
     */
    private const API_URL = 'https://geo.api.gouv.fr/communes';

    /**
     * Récupère les villes correspondant à un code postal
     *
     * @param string $postalCode
     * @return array
     */
    public static function getCitiesByPostalCode(string $postalCode): array
    {
        try {
            // Validation du code postal (5 chiffres)
            if (!preg_match('/^\d{5}$/', $postalCode)) {
                return [
                    'success' => false,
                    'message' => 'Code postal invalide. Veuillez saisir 5 chiffris.',
                    'cities' => []
                ];
            }

            // Appel à l'API Geo française
            $response = Http::timeout(10)->get(self::API_URL, [
                'codePostal' => $postalCode,
                'fields' => 'nom,code,codesPostaux,population',
                'format' => 'json'
            ]);

            if (!$response->successful()) {
                Log::warning("Erreur API Geo pour le code postal {$postalCode}: " . $response->status());
                return [
                    'success' => false,
                    'message' => 'Erreur lors de la récupération des villes.',
                    'cities' => []
                ];
            }

            $cities = $response->json();

            if (empty($cities)) {
                return [
                    'success' => false,
                    'message' => 'Aucune ville trouvée pour ce code postal.',
                    'cities' => []
                ];
            }

            // Formatage des résultats
            $formattedCities = collect($cities)->map(function ($city) {
                return [
                    'code' => $city['code'],
                    'name' => $city['nom'],
                    'postal_codes' => $city['codesPostaux'] ?? [],
                    'population' => $city['population'] ?? 0
                ];
            })->sortBy('name')->values()->toArray();

            return [
                'success' => true,
                'message' => count($formattedCities) . ' ville(s) trouvée(s).',
                'cities' => $formattedCities
            ];

        } catch (Exception $e) {
            Log::error("Erreur CityService pour le code postal {$postalCode}: " . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Erreur lors de la récupération des villes.',
                'cities' => []
            ];
        }
    }
}