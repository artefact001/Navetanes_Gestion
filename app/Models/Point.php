<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipe_id',
        'matche_id',
        'points',
    ];

    // Relation avec l'équipe
    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }

    // Relation avec le match
    public function matche()
    {
        return $this->belongsTo(Matche::class);
    }
}
