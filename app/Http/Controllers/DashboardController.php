<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ValidationRequest;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    // Méthode pour récupérer et afficher les statistiques du tableau de bord
    public function getStats(): JsonResponse
    {
        $stats = $this->dashboardService->getDashboardStats();

        return response()->json([
            'message' => 'Statistiques du tableau de bord récupérées avec succès.',
            'data' => $stats
        ], 200);
    }
}
