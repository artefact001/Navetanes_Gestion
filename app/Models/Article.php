<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'contenu',
        'user_id',
        'file_path' // Nouveau champ pour stocker le chemin du fichier
    ];

    // Relation avec les utilisateurs
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec les commentaires
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}
