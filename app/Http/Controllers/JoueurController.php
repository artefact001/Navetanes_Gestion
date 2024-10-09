<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationRequest;

use App\Http\Requests\JoueurRequest;
use App\Services\JoueurService;
use Illuminate\Http\JsonResponse;

class JoueurController extends Controller
{
    protected $joueurService;

    public function __construct(JoueurService $joueurService)
    {
        $this->joueurService = $joueurService;
    }

    /**
     * Récupérer tous les joueurs.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $joueurs = $this->joueurService->recupererTousLesJoueurs();
        return response()->json($joueurs, 200);
    }

    /**
     * Créer un nouveau joueur.
     *
     * @param JoueurRequest $request
     * @return JsonResponse
     */
    public function store(JoueurRequest $request): JsonResponse
    {
        $joueur = $this->joueurService->creerJoueur($request->validated());
        return response()->json($joueur, 201);
    }

    /**
     * Afficher un joueur spécifique.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $joueur = $this->joueurService->recupererJoueurParId($id);
        return response()->json($joueur, 200);
    }

    /**
     * Mettre à jour un joueur existant.
     *
     * @param JoueurRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(JoueurRequest $request, int $id): JsonResponse
    {
        $joueur = $this->joueurService->recupererJoueurParId($id);
        $joueur = $this->joueurService->mettreAJourJoueur($joueur, $request->validated());
        return response()->json($joueur, 200);
    }

    /**
     * Supprimer un joueur.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $joueur = $this->joueurService->recupererJoueurParId($id);
        $this->joueurService->supprimerJoueur($joueur);
        return response()->json(null, 204);
    }
}
