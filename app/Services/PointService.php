<?php


namespace App\Services;

use App\Models\Point;
use App\Models\Resultat;

class PointService
{
    // Calculer et attribuer des points en fonction des résultats d'un match
    public function calculatePoints(Resultat $resultat)
    {
        $points = 0;

        // Si l'équipe est gagnante, elle obtient 3 points
        if ($resultat->is_winner) {
            $points = 3; // Victoire
        } 
        // Si le score de l'équipe est égal au score de l'adversaire, c'est un match nul
        elseif ($resultat->score === $this->getOpponentScore($resultat->match_id, $resultat->equipe_id)) {
            $points = 1; // Match nul
        } 
        // Sinon, c'est une défaite, donc 0 points
        else {
            $points = 0; // Défaite
        }

        // Enregistrer ou mettre à jour les points dans la table points
        Point::updateOrCreate(
            ['equipe_id' => $resultat->equipe_id, 'match_id' => $resultat->match_id],
            ['points' => $points]
        );
    }

    // Récupérer le score de l'équipe adverse
    private function getOpponentScore($matchId, $equipeId)
    {
        $opponentResult = Resultat::where('matche_id', $matcheId)
                                  ->where('equipe_id', '!=', $equipeId)
                                  ->first();

        return $opponentResult ? $opponentResult->score : 0;
    }

    // Obtenir les points totaux d'une équipe
    public function getTeamPoints($equipeId)
    {
        return Point::where('equipe_id', $equipeId)->sum('points');
    }

    // Obtenir le classement global des équipes
    public function getRankings()
    {
        return Point::selectRaw('equipe_id, SUM(points) as total_points')
            ->groupBy('equipe_id')
            ->orderByDesc('total_points')
            ->with('equipe')
            ->get();
    }
}
