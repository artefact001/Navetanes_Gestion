<?php



namespace App\Services;

use App\Models\Resultat;

class ResultatService
{
    // Créer ou mettre à jour un résultat avec buteurs, passeurs et homme du match
    public function storeResultat(array $data)
    {
        $resultat = Resultat::updateOrCreate(
            ['match_id' => $data['match_id'], 'equipe_id' => $data['equipe_id']],
            [
                'score' => $data['score'],
                'is_winner' => $data['is_winner'],
                'buteurs' => $data['buteurs'], // Liste d'IDs des buteurs
                'passeurs' => $data['passeurs'], // Liste d'IDs des passeurs
                'homme_du_match' => $data['homme_du_match'], // ID de l'homme du match
            ]
        );

        return $resultat;
    }

    // Retourner tous les résultats pour un match donné
    public function getResultatsByMatch($matchId)
    {
        return Resultat::where('match_id', $matchId)->with('equipe', 'hommeDuMatch')->get();
    }

    // Déterminer et mettre à jour l'équipe gagnante
    public function determineWinner($matchId)
    {
        $resultats = Resultat::where('match_id', $matchId)->get();

        $winner = $resultats->sortByDesc('score')->first();

        foreach ($resultats as $resultat) {
            $resultat->update(['is_winner' => $resultat->id == $winner->id]);
        }

        return $winner->equipe;
    }
}
