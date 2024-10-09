<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueJoueurEquipe extends Model
{
    use HasFactory;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = ['joueur_id', 'equipe_id', 'date_debut', 'date_fin'];

    /**
     * La relation avec le modèle Joueur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function joueur()
    {
        return $this->belongsTo(Joueur::class);
    }

    /**
     * La relation avec le modèle Equipe.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }
}
