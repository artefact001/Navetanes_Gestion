<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultat extends Model
{
    use HasFactory;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = ['matche_id', 'carton_jaune', 'carton_rouge', 'detail_but', 'score_local', 'score_visiteur'];

    /**
     * La relation avec le modèle Match.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function match()
    {
        return $this->belongsTo(Matche::class);
    }
}
