<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = ['nom'];

    /**
     * La relation avec le modèle Joueur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function joueurs()
    {
        return $this->hasMany(Joueur::class);
    }
}
