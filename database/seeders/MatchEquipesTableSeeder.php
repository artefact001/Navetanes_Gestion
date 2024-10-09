<?php

use Illuminate\Database\Seeder;
use App\Models\MatchEquipe;
use App\Models\Matche;

class MatcheEquipesTableSeeder extends Seeder
{
    public function run()
    {
        MatchEquipe::truncate(); // Optionnel : Pour vider la table avant de remplir

        $matches = Matche::all();

        // Vérifiez qu'il y a des matchs
        if ($matches->isEmpty()) {
            $this->command->error('Aucun match disponible pour l\'association des équipes.');
            return;
        }

        $matchEquipesData = [];

        foreach ($matchs as $match) {
            $matchEquipesData[] = [
                'matche_id' => $matche->id,
                'equipe_id' => $match->equipe_local,
            ];
            $matchEquipesData[] = [
                'matche_id' => $matche->id,
                'equipe_id' => $matche->equipe_visiteur,
            ];
        }

        // Insérer les associations en une seule requête
        MatcheEquipe::insert($matcheEquipesData);
    }
}
