<?php


namespace App\Services;

use App\Models\Calendrier;

class CalendrierService
{
    // Créer un nouveau calendrier
    public function createCalendrier(array $data)
    {
        return Calendrier::create([
            'match_id' => $data['match_id'],
            'date_heure' => $data['date_heure'],
            'lieu' => $data['lieu'],
        ]);
    }

    // Mettre à jour un calendrier
    public function updateCalendrier(Calendrier $calendrier, array $data)
    {
        $calendrier->update($data);
        return $calendrier;
    }

    // Supprimer un calendrier
    public function deleteCalendrier(Calendrier $calendrier)
    {
        $calendrier->delete();
    }

    // Récupérer tous les calendriers
    public function getAllCalendriers()
    {
        return Calendrier::with('match')->get(); // Inclure les informations sur les matchs
    }

    // Récupérer les calendriers d'un match spécifique
    public function getCalendrierByMatch($matchId)
    {
        return Calendrier::where('match_id', $matchId)->with('match')->get();
    }
}
