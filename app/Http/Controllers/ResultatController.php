<?php



namespace App\Http\Controllers;

use App\Http\Requests\ValidationRequest;

use App\Http\Requests\ResultatRequest;
use App\Services\ResultatService;
use Illuminate\Http\JsonResponse;

class ResultatController extends Controller
{
    protected $resultatService;

    public function __construct(ResultatService $resultatService)
    {
        $this->resultatService = $resultatService;
    }

    // Créer ou mettre à jour un résultat
    public function store(ResultatRequest $request): JsonResponse
    {
        $resultat = $this->resultatService->storeResultat($request->validated());

        return response()->json([
            'message' => 'Résultat enregistré avec succès.',
            'resultat' => $resultat,
        ]);
    }

    // Récupérer les résultats d'un match
    public function show($matchId): JsonResponse
    {
        $resultats = $this->resultatService->getResultatsByMatch($matchId);

        return response()->json($resultats);
    }

    // Déterminer l'équipe gagnante
    public function determineWinner($matchId): JsonResponse
    {
        $winner = $this->resultatService->determineWinner($matchId);

        return response()->json([
            'message' => 'Équipe gagnante déterminée avec succès.',
            'winner' => $winner,
        ]);
    }
}
