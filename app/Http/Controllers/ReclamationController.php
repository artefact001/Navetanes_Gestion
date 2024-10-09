<?php

namespace App\Http\Controllers;
use App\Http\Requests\ValidationRequest;

use App\Http\Requests\ReclamationRequest;
use App\Services\ReclamationService;
use Illuminate\Http\JsonResponse;

class ReclamationController extends Controller
{
    protected $reclamationService;

    public function __construct(ReclamationService $reclamationService)
    {
        $this->reclamationService = $reclamationService;
    }

    // Méthode pour créer une réclamation
    public function store(ReclamationRequest $request): JsonResponse
    {
        $reclamation = $this->reclamationService->createReclamation([
            'user_id' => auth()->id(),
            'equipe_id' => auth()->user()->equipe_id, // L'équipe de l'utilisateur qui fait la réclamation
            'description' => $request->description,
        ]);

        return response()->json($reclamation, 201);
    }

    // Méthode pour changer le statut d'une réclamation
    public function updateStatus($id, Request $request): JsonResponse
    {
        $status = $request->input('status');
        $reclamation = $this->reclamationService->changeStatus($id, $status);

        return response()->json($reclamation);
    }
}
