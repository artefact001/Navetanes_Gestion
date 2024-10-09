<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = ['nom', 'localite', 'user_id'];

    /**
     * La relation avec le modèle User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * La relation avec le modèle Equipe.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function equipes()
    {
        return $this->hasMany(Equipe::class);
    }
}
