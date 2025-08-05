<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SimCard extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     */
    protected $fillable = [
        'work_reception_id',
        'option',
        'operator',
        'sim_number',
    ];

    /**
     * Relation avec le formulaire de réception de travaux.
     */
    public function workReception(): BelongsTo
    {
        return $this->belongsTo(WorkReception::class);
    }

    /**
     * Les options disponibles pour les cartes SIM.
     */
    public static function getOptions(): array
    {
        return ['Backup', 'Routeur 4G', 'Téléphonie'];
    }

    /**
     * Les opérateurs disponibles.
     */
    public static function getOperators(): array
    {
        return ['Free', 'Orange', 'Bouygues'];
    }
}