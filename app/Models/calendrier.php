<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendrier extends Model
{
    use HasFactory;

    protected $fillable = [
        'matche_id',
        'date_heure', // Date et heure du matche
        'lieu',       // Lieu du matche
    ];

    // Relation avec le modèle Match
    public function matche()
    {
        return $this->belongsTo(Matche::class);
    }
}
