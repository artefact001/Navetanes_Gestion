<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetitionRequest;
use App\Models\Competition;
use App\Http\Requests\ValidationRequest;

use App\Services\CompetitionService;
use Illuminate\Http\JsonResponse;

class CompetitionController extends Controller
{
    protected $competitionService;

    public function __construct(CompetitionService $competitionService)
    {
        $this->competitionService = $competitionService;
    }

    /**
     * Afficher la liste des compétitions.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $competitions = $this->competitionService->recupererToutesLesCompetitions();
        return response()->json($competitions, 200);
    }

    /**
     * Créer une nouvelle compétition.
     *
     * @param CompetitionRequest $request
     * @return JsonResponse
     */
    public function store(CompetitionRequest $request): JsonResponse
    {
        $competition = $this->competitionService->creerCompetition($request->validated());
        return response()->json($competition, 201);
    }

    /**
     * Afficher une compétition spécifique.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $competition = $this->competitionService->recupererCompetitionParId($id);
        return response()->json($competition, 200);
    }

    /**
     * Mettre à jour une compétition existante.
     *
     * @param CompetitionRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CompetitionRequest $request, int $id): JsonResponse
    {
        $competition = $this->competitionService->recupererCompetitionParId($id);
        $competition = $this->competitionService->mettreAJourCompetition($competition, $request->validated());
        return response()->json($competition, 200);
    }

    /**
     * Supprimer une compétition.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $competition = $this->competitionService->recupererCompetitionParId($id);
        $this->competitionService->supprimerCompetition($competition);
        return response()->json(null, 204);
    }
}
