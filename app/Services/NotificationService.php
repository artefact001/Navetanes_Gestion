<?php


namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    // Crée une notification dans la base de données
    public function creerNotification($titre, $message, $userId, $type = 'general')
    {
        Notification::create([
            'titre' => $titre,
            'message' => $message,
            'user_id' => $userId,
            'type' => $type,
        ]);
    }

    // Envoyer un email avec la notification
    public function envoyerNotificationEmail(User $user, $titre, $message)
    {
        // Logique pour envoyer un e-mail
        Mail::to($user->email)->send(new \App\Mail\NotificationMail($titre, $message));
    }

    // Envoyer une notification par exemple pour un match terminé
    public function notifierResultatMatche($matche)
    {
        $titre = 'Résultat du matche';
        $message = "Le matche {$matche->equipe1->nom} contre {$matche->equipe2->nom} s'est terminé avec le score {$matche->score_equipe1} - {$matche->score_equipe2}.";

        foreach (User::all() as $user) {
            $this->creerNotification($titre, $message, $user->id, 'resultat');
            $this->envoyerNotificationEmail($user, $titre, $message);
        }
    }

    // Notification pour changement de programme
    public function notifierChangementProgramme($calendrier)
    {
        $titre = 'Changement de programme';
        $message = "Le programme pour l'événement {$calendrier->nom} a changé.";

        foreach (User::all() as $user) {
            $this->creerNotification($titre, $message, $user->id, 'calendrier');
            $this->envoyerNotificationEmail($user, $titre, $message);
        }
    }

    // Ajouter d'autres méthodes pour différents événements clés.
}
