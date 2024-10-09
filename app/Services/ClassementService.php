<?php




namespace App\Services;

use App\Models\Point;

class ClassementService
{
    // Récupérer le classement global des équipes
    public function getTeamRankings()
    {
        return Point::selectRaw('equipe_id, SUM(points) as total_points')
            ->groupBy('equipe_id')
            ->orderByDesc('total_points')
            ->with('equipe') // Récupérer les informations de l'équipe
            ->get();
    }

    // Récupérer le classement d'une seule équipe
    public function getTeamRank($equipeId)
    {
        $ranking = Point::selectRaw('equipe_id, SUM(points) as total_points')
            ->groupBy('equipe_id')
            ->orderByDesc('total_points')
            ->get();

        // Retourner le rang de l'équipe recherchée
        foreach ($ranking as $index => $rank) {
            if ($rank->equipe_id == $equipeId) {
                return ['rank' => $index + 1, 'points' => $rank->total_points];
            }
        }
        
        return null; // Si l'équipe n'est pas classée
    }
}
