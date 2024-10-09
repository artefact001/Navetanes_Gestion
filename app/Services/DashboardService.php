<?php


namespace App\Services;

use App\Models\Equipe;
use App\Models\Matche;
use App\Models\Competition;
use App\Models\Calendrier;

class DashboardService
{
    // Récupérer les statistiques globales pour le tableau de bord
    public function getDashboardStats()
    {
        return [
            'nombre_equipes' => Equipe::count(),               // Nombre total d'équipes
            'nombre_matches' => Matche::count(),                 // Nombre total de matchs
            'nombre_competitions' => Competition::count(),     // Nombre total de compétitions
            'nombre_calendriers' => Calendrier::count(),       // Nombre total de calendriers (horaires)
        ];
    }

    // Vous pouvez ajouter d'autres statistiques ici en fonction des besoins.
}
