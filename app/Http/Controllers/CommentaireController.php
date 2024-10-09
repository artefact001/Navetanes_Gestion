<?php


namespace App\Http\Controllers;

use App\Http\Requests\ValidationRequest;
use App\Models\Commentaire;
use App\Http\Requests\CommentaireRequest;
use App\Services\CommentaireService;

class CommentaireController extends Controller
{
    protected $commentaireService;

    public function __construct(CommentaireService $commentaireService)
    {
        $this->commentaireService = $commentaireService;
    }

    /**
     * Crée un nouveau commentaire pour un article.
     */
    public function store(CommentaireRequest $request)
    {
        $commentaire = $this->commentaireService->createCommentaire($request->validated());
        return response()->json($commentaire, 201); // Code 201 pour la création
    }

    /**
     * Supprime un commentaire.
     */
    public function destroy($id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $this->commentaireService->deleteCommentaire($commentaire);
        return response()->json(['message' => 'Commentaire supprimé avec succès']);
    }
}
