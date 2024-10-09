<?php


// app/Services/ReclamationService.php
namespace App\Services;

use App\Models\Reclamation;
use App\Notifications\ReclamationStatusChanged;
use Illuminate\Support\Facades\Notification;

class ReclamationService
{
    // Fonction pour créer une réclamation
    public function createReclamation(array $data)
    {
        return Reclamation::create($data);
    }

    // Fonction pour changer le statut d'une réclamation
    public function changeStatus($id, $status)
    {
        $reclamation = Reclamation::findOrFail($id);

        // Vérifie si l'utilisateur appartient à la zone de l'équipe
        if (auth()->user()->equipe_id !== $reclamation->equipe_id) {
            throw new \Exception('Vous n\'êtes pas autorisé à changer le statut de cette réclamation.');
        }

        $reclamation->status = $status;
        $reclamation->save();

        // Envoyer une notification à l'utilisateur concerné
        Notification::send($reclamation->user, new ReclamationStatusChanged($reclamation));

        return $reclamation;
    }
}
