<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = ['nom', 'date_debut', 'date_fin'];

    /**
     * La relation avec le modèle Equipe.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function equipes()
    {
        return $this->belongsToMany(Equipe::class, 'competition_equipe');
    }

    /**
     * La relation avec le modèle Match.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matchs()
    {
        return $this->hasMany(Matche::class);
    }

    /**
     * La relation avec le modèle Tirage.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tirages()
    {
        return $this->hasMany(Tirage::class);
    }
}
