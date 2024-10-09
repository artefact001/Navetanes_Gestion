<?php


namespace App\Http\Controllers;

use App\Http\Requests\ValidationRequest;
use App\Services\ClassementService;
use Illuminate\Http\JsonResponse;

class ClassementController extends Controller
{
    protected $classementService;

    public function __construct(ClassementService $classementService)
    {
        $this->classementService = $classementService;
    }

    // Afficher le classement global des équipes
    public function getGlobalRankings(): JsonResponse
    {
        $rankings = $this->classementService->getTeamRankings();

        return response()->json($rankings);
    }

    // Afficher le classement d'une équipe spécifique
    public function getTeamRank($equipeId): JsonResponse
    {
        $rank = $this->classementService->getTeamRank($equipeId);

        if ($rank) {
            return response()->json($rank);
        } else {
            return response()->json(['message' => 'Équipe non classée'], 404);
        }
    }

    public function index()
{
    $classements = Classement::with('equipe')->orderBy('points', 'desc')->get();

    return response()->json($classements);
}

}
