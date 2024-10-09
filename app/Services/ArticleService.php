<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleService
{
    /**
     * Crée un nouvel article avec un fichier.
     *
     * @param array $data
     * @return Article
     */
    public function createArticle(array $data): Article
    {
        // Si un fichier est présent, nous le stockons
        if (isset($data['file'])) {
            $filePath = $data['file']->store('articles', 'public'); // Sauvegarde dans le dossier "articles"
        } else {
            $filePath = null; // Pas de fichier
        }

        return Article::create([
            'titre' => $data['titre'],
            'contenu' => $data['contenu'],
            'user_id' => Auth::id(),
            'file_path' => $filePath, // Chemin du fichier stocké
        ]);
    }

    /**
     * Met à jour un article avec ou sans fichier.
     *
     * @param Article $article
     * @param array $data
     * @return Article
     */
    public function updateArticle(Article $article, array $data): Article
    {
        // Gérer la mise à jour du fichier, si un nouveau fichier est téléchargé
        if (isset($data['file'])) {
            // Supprimer l'ancien fichier s'il existe
            if ($article->file_path) {
                Storage::disk('public')->delete($article->file_path);
            }

            // Stocker le nouveau fichier
            $filePath = $data['file']->store('articles', 'public');
        } else {
            $filePath = $article->file_path; // Conserver l'ancien chemin si pas de nouveau fichier
        }

        $article->update([
            'titre' => $data['titre'],
            'contenu' => $data['contenu'],
            'file_path' => $filePath,
        ]);

        return $article;
    }

    /**
     * Supprime un article et son fichier associé.
     *
     * @param Article $article
     * @return void
     */
    public function deleteArticle(Article $article): void
    {
        if ($article->file_path) {
            Storage::disk('public')->delete($article->file_path);
        }

        $article->delete();
    }
}
