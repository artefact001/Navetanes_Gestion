<?php

use Illuminate\Database\Seeder;
use App\Models\Competition;
use App\Models\Equipe;
use Illuminate\Support\Facades\DB;

class CompetitionEquipeTableSeeder extends Seeder
{
    public function run()
    {
        // Vider la table
        DB::table('competition_equipe')->truncate(); // Optionnel : Pour vider la table avant de remplir

        // Récupérer toutes les compétitions et équipes
        $competitions = Competition::all();
        $equipes = Equipe::all();

        // Assurer qu'il y a au moins 3 équipes
        if ($equipes->count() < 3) {
            $this->command->error('Il faut au moins 3 équipes pour cette opération.');
            return;
        }

        // Tableau pour stocker les données à insérer
        $competitionEquipeData = [];

        foreach ($competitions as $competition) {
            // Mélanger les équipes et prendre les 3 premières
            $randomEquipes = $equipes->shuffle()->take(3);

            foreach ($randomEquipes as $equipe) {
                $competitionEquipeData[] = [
                    'competition_id' => $competition->id,
                    'equipe_id' => $equipe->id,
                ];
            }
        }

        // Insérer les données en une seule requête
        DB::table('competition_equipe')->insert($competitionEquipeData);
    }
}
