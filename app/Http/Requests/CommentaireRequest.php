<?php



namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentaireRequest extends FormRequest
{
    /**
     * Autorise l'utilisateur à faire cette requête.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Assurez-vous que seuls les utilisateurs autorisés peuvent commenter
    }

    /**
     * Règles de validation pour les commentaires.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'contenu' => 'required|string',
            'article_id' => 'required|exists:articles,id',
        ];
    }
}

