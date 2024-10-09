<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matche extends Model
{
    use HasFactory;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = ['date', 'lieu', 'equipe_local', 'equipe_visiteur'];

    /**
     * La relation avec le modèle Equipe pour l'équipe locale.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipeLocal()
    {
        return $this->belongsTo(Equipe::class, 'equipe_local');
    }

    /**
     * La relation avec le modèle Equipe pour l'équipe visiteur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipeVisiteur()
    {
        return $this->belongsTo(Equipe::class, 'equipe_visiteur');
    }

    /**
     * La relation avec le modèle Resultat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function resultat()
    {
        return $this->hasOne(Resultat::class);
    }
}
