<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasFactory, HasRoles;

    // Définit la table associée au modèle (facultatif, car Laravel le devine par convention)
    protected $table = 'users';

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'email',
        'password',
    ];

    /**
     * Les attributs qui doivent être cachés pour les tableaux.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * La relation un à un avec la table 'zones'.
     */
    public function zone()
    {
        return $this->hasOne(Zone::class);
    }

    /**
     * La relation un à un avec la table 'equipes'.
     */
    public function equipe()
    {
        return $this->hasOne(Equipe::class);
    }

    /**
     * La relation un à plusieurs avec la table 'notifications'.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Pour obtenir les rôles de l'utilisateur
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
