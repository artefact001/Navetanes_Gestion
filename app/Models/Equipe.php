<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use HasFactory;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = ['nom', 'logo', 'date_creer', 'zone_id', 'user_id'];

    /**
     * La relation avec le modèle Zone.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * La relation avec le modèle User (gestionnaire de l'équipe).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);  // Le gestionnaire de l'équipe
    }

    /**
     * La relation un à plusieurs avec le modèle Joueur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function joueurs()
    {
        return $this->hasMany(Joueur::class);
    }

    /**
     * La relation plusieurs à plusieurs avec le modèle Competition.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function competitions()
    {
        return $this->belongsToMany(Competition::class, 'competition_equipe');
    }

    /**
     * La relation un à plusieurs avec le modèle Match pour les matchs locaux.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matchsLocaux()
    {
        return $this->hasMany(Matches::class, 'equipe_local');
    }

    /**
     * La relation un à plusieurs avec le modèle Match pour les matchs visiteurs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matchsVisiteurs()
    {
        return $this->hasMany(Matche::class, 'equipe_visiteur');
    }

    /**
     * La relation un à plusieurs avec le modèle Reclamation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reclamations()
    {
        return $this->hasMany(Reclamation::class);
    }
}
