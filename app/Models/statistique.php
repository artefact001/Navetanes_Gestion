<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistique extends Model
{
    use HasFactory;

    // Définir la table associée
    protected $table = 'statistiques';

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'joueur_id',
        'equipe_id',
        // 'minutes_jouees',
        'buts',
        'passeurs',
        // 'tirs',
        // 'dribbles_reussis',
        // 'interceptions',
        // 'fautes_commises',
        'cartons_jaunes',
        'cartons_rouges',
        // 'distance_parcourue',
        // 'evaluation',
    ];

    // Relation avec le joueur
    public function joueur()
    {
        return $this->belongsTo(Joueur::class);
    }

    // Relation avec l'équipe
    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }
}
