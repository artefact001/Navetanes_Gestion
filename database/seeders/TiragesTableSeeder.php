<?php

use Illuminate\Database\Seeder;
use App\Models\Tirage;
use App\Models\Competition;

class TiragesTableSeeder extends Seeder
{
    public function run()
    {
        Tirage::truncate(); // Optionnel : Pour vider la table avant de remplir

        $competitions = Competition::all();

        // Vérifiez qu'il y a des compétitions
        if ($competitions->isEmpty()) {
            $this->command->error('Aucune compétition disponible pour créer des tirages.');
            return;
        }

        $tirageData = [];

        foreach ($competitions as $competition) {
            // Créer des phases et poules de manière dynamique ou définie
            $phase = json_encode(['phase_1' => 'A']);
            $poul = json_encode(['poule_A' => ['Équipe 1', 'Équipe 2', 'Équipe 3', 'Équipe 4']]); // Exemples d'équipes

            $tirageData[] = [
                'competition_id' => $competition->id,
                'phase' => $phase,
                'poul' => $poul,
            ];
        }

        // Insérer les tirages en une seule requête
        Tirage::insert($tirageData);
    }
}
