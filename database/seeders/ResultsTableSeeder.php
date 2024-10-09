<?php

use Illuminate\Database\Seeder;
use App\Models\Resultat;
use App\Models\Matche;

class ResultatsTableSeeder extends Seeder
{
    public function run()
    {
        Resultat::truncate(); // Optionnel : Pour vider la table avant de remplir

        $matches = Matche::all();

        // Vérifiez qu'il y a des matchs
        if ($matches->isEmpty()) {
            $this->command->error('Aucun match disponible pour créer des résultats.');
            return;
        }

        $resultatData = [];

        // Créer des résultats
        foreach ($matches as $matche) {
            $scoreLocal = rand(0, 5);
            $scoreVisiteur = rand(0, 5);

            $resultatData[] = [
                'matche_id' => $matche->id,
                'carton_jaune' => rand(0, 5),
                'carton_rouge' => rand(0, 2),
                'detail_but' => 'But marqué par ' . rand(1, 10) . ' joueurs.',
                'score_local' => $scoreLocal,
                'score_visiteur' => $scoreVisiteur,
            ];
        }

        // Insérer les résultats en une seule requête
        Resultat::insert($resultatData);
    }
}
