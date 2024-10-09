<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joueur extends Model
{
    use HasFactory;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = ['nom', 'age', 'licence', 'equipe_id', 'categorie_id'];

    /**
     * La relation avec le modèle Equipe.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }

    /**
     * La relation avec le modèle Categorie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    /**
     * La relation un à plusieurs avec le modèle HistoriqueJoueurEquipe.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historique()
    {
        return $this->hasMany(HistoriqueJoueurEquipe::class);
    }
}
