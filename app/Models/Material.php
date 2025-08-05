<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Material extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     */
    protected $fillable = [
        'work_reception_id',
        'name',
        'type',
        'quantity',
        'description',
    ];

    /**
     * Les attributs qui doivent être castés.
     */
    protected $casts = [
        'quantity' => 'integer',
    ];

    /**
     * Relation avec le formulaire de réception de travaux.
     */
    public function workReception(): BelongsTo
    {
        return $this->belongsTo(WorkReception::class);
    }

    /**
     * Les types de matériels disponibles.
     */
    public static function getTypes(): array
    {
        return [
            'Routeur',
            'Antenne',
            'Téléphonie',
            'Accessoire',
            'Câblage',
            'Autre'
        ];
    }

    /**
     * Modèles prédéfinis par type.
     */
    public static function getModelsByType(): array
    {
        return [
            'Routeur' => [
                'Huawei B535',
                'ZTE MF286R',
                'Huawei B311',
                'ZTE MF283+',
            ],
            'Antenne' => [
                'Antenne 4G extérieure',
                'Antenne 4G intérieure',
                'Antenne directionnelle',
                'Antenne omnidirectionnelle',
            ],
            'Téléphonie' => [
                'Kit téléphonie IP',
                'Téléphone IP',
                'Adaptateur téléphonique',
                'Combiné sans fil',
            ],
            'Accessoire' => [
                'Câble Ethernet',
                'Adaptateur secteur',
                'Support de fixation',
                'Connecteurs',
            ],
            'Câblage' => [
                'Câble coaxial',
                'Câble Ethernet Cat6',
                'Câble fibre optique',
                'Gaine de protection',
            ],
            'Autre' => [
                'Autre matériel'
            ]
        ];
    }
}