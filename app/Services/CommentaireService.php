<?php

namespace App\Services;

use App\Models\Commentaire;
use Illuminate\Support\Facades\Auth;

class CommentaireService
{
    /**
     * Crée un nouveau commentaire
     *
     * @param array $data
     * @return Commentaire
     */
    public function createCommentaire(array $data): Commentaire
    {
        return Commentaire::create([
            'contenu' => $data['contenu'],
            'article_id' => $data['article_id'],
            'user_id' => Auth::id(), // Utilisateur connecté
        ]);
    }

    /**
     * Supprime un commentaire
     *
     * @param Commentaire $commentaire
     * @return void
     */
    public function deleteCommentaire(Commentaire $commentaire): void
    {
        $commentaire->delete();
    }
}
