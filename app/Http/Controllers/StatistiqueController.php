<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatistiqueRequest;
use App\Services\StatistiqueService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ValidationRequest;

class StatistiqueController extends Controller
{
    protected $statistiqueService;

    // Injection du service de statistiques
    public function __construct(StatistiqueService $statistiqueService)
    {
        $this->statistiqueService = $statistiqueService;
    }

    // Méthode pour créer une nouvelle statistique
    public function store(StatistiqueRequest $request): JsonResponse
    {
        $statistique = $this->statistiqueService->createStatistique($request->validated());

        return response()->json([
            'message' => 'Statistique créée avec succès.',
            'data' => $statistique,
        ], 201);
    }

    // Méthode pour récupérer toutes les statistiques
    public function index(): JsonResponse
    {
        $statistiques = $this->statistiqueService->getAllStatistiques();

        return response()->json([
            'message' => 'Statistiques récupérées avec succès.',
            'data' => $statistiques,
        ], 200);
    }

    // Méthode pour récupérer les statistiques d'un joueur spécifique
    public function showByJoueur($joueurId): JsonResponse
    {
        $statistiques = $this->statistiqueService->getStatistiquesByJoueur($joueurId);

        return response()->json([
            'message' => 'Statistiques du joueur récupérées avec succès.',
            'data' => $statistiques,
        ], 200);
    }

    // Méthode pour mettre à jour une statistique
    public function update(StatistiqueRequest $request, $id): JsonResponse
    {
        $statistique = $this->statistiqueService->updateStatistique($id, $request->validated());

        return response()->json([
            'message' => 'Statistique mise à jour avec succès.',
            'data' => $statistique,
        ], 200);
    }

    // Méthode pour supprimer une statistique
    public function destroy($id): JsonResponse
    {
        $this->statistiqueService->deleteStatistique($id);

        return response()->json([
            'message' => 'Statistique supprimée avec succès.',
        ], 200);
    }
}
