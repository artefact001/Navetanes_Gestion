<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = ['contenu', 'article_id', 'user_id'];

    /**
     * Un commentaire appartient à un article.
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Un commentaire appartient à un utilisateur (auteur).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
