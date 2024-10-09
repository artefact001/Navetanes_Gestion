<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Requests\ValidationRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    // Méthode pour récupérer les notifications de l'utilisateur
    public function index(): JsonResponse
    {
        // Récupération des notifications de l'utilisateur authentifié
        $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->get();

        return response()->json([
            'message' => 'Notifications récupérées avec succès.',
            'data' => $notifications
        ], 200);
    }

    // Marquer une notification comme lue
    public function markAsRead($id): JsonResponse
    {
        // Trouver la notification par son ID et la marquer comme lue
        $notification = Notification::findOrFail($id);
        $notification->status = true;  // Met à jour le statut à "lu"
        $notification->save();  // Sauvegarde la modification

        return response()->json([
            'message' => 'Notification marquée comme lue.',
        ], 200);
    }

    // Marquer toutes les notifications comme lues
    public function markAllAsRead(): JsonResponse
    {
        // Met à jour le statut de toutes les notifications de l'utilisateur à "lu"
        Auth::user()->notifications()->update(['status' => true]);

        return response()->json([
            'message' => 'Toutes les notifications ont été marquées comme lues.',
        ], 200);
    }
}
