<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalendrierRequest;
use App\Models\Calendrier;
use App\Services\CalendrierService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ValidationRequest;

class CalendrierController extends Controller
{
    protected $calendrierService;

    public function __construct(CalendrierService $calendrierService)
    {
        $this->calendrierService = $calendrierService;
    }

    // Créer un nouveau calendrier
    public function create(CalendrierRequest $request): JsonResponse
    {
        $calendrier = $this->calendrierService->createCalendrier($request->validated());

        return response()->json(['message' => 'Calendrier créé avec succès', 'calendrier' => $calendrier], 201);
    }

    // Mettre à jour un calendrier
    public function update(CalendrierRequest $request, Calendrier $calendrier): JsonResponse
    {
        $updatedCalendrier = $this->calendrierService->updateCalendrier($calendrier, $request->validated());

        return response()->json(['message' => 'Calendrier mis à jour avec succès', 'calendrier' => $updatedCalendrier], 200);
    }

    // Supprimer un calendrier
    public function delete(Calendrier $calendrier): JsonResponse
    {
        $this->calendrierService->deleteCalendrier($calendrier);

        return response()->json(['message' => 'Calendrier supprimé avec succès'], 200);
    }

    // Récupérer tous les calendriers
    public function getAll(): JsonResponse
    {
        $calendriers = $this->calendrierService->getAllCalendriers();

        return response()->json($calendriers, 200);
    }

    // Récupérer les calendriers d'un match spécifique
    public function getByMatch($matchId): JsonResponse
    {
        $calendriers = $this->calendrierService->getCalendrierByMatch($matchId);

        return response()->json($calendriers, 200);
    }
}
