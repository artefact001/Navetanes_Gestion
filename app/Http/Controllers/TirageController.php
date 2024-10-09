<?php

namespace App\Http\Controllers;

use App\Http\Requests\TirageRequest;
use App\Services\TirageService;
use App\Models\Equipe;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ValidationRequest;

class TirageController extends Controller
{
    protected $tirageService;

    public function __construct(TirageService $tirageService)
    {
        $this->tirageService = $tirageService;
    }

    /**
     * Lancer un tirage de poules.
     *
     * @param TirageRequest $request
     * @return JsonResponse
     */
    public function lancerTirage(TirageRequest $request): JsonResponse
    {
        // Récupérer les équipes de la compétition
        $equipes = Equipe::where('competition_id', $request->competition_id)->pluck('id')->toArray();

        // Générer les poules
        $poules = $this->tirageService->genererPoules($request->nombre_poules, $equipes);

        // Créer le tirage avec les poules générées
        $tirage = $this->tirageService->creerTirage([
            'phase' => $request->phase,
            'competition_id' => $request->competition_id,
            'poules' => json_encode($poules),
            'nombre_poules' => $request->nombre_poules,
        ]);

        return response()->json($tirage, 201);
    }
}
