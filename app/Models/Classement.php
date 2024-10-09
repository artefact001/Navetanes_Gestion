<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classement extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipe_id',
        'matches_joues',
        'gagne',
        'nul',
        'perdu',
        'buts_marques',
        'buts_encaisses',
        'diff_buts',
        'points',
    ];

    // Relation avec l'équipe
    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }
}
