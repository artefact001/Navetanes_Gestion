<?php

use Illuminate\Database\Seeder;
use App\Models\Matche;
use App\Models\Equipe;

class MatchesTableSeeder extends Seeder
{
    public function run()
    {
        Matche::truncate(); // Optionnel : Pour vider la table avant de remplir

        $equipes = Equipe::all();

        // Vérifiez qu'il y a suffisamment d'équipes
        if ($equipes->count() < 2) {
            $this->command->error('Il faut au moins 2 équipes pour créer des matchs.');
            return;
        }

        $matcheData = [];

        // Créer des matchs
        for ($i = 0; $i < 10; $i++) {
            $equipeLocal = $equipes->random();
            $equipeVisiteur = $equipes->where('id', '!=', $equipeLocal->id)->random();

            $matchData[] = [
                'date' => now()->addDays(rand(1, 30)),
                'equipe_local' => $equipeLocal->id,
                'equipe_visiteur' => $equipeVisiteur->id,
            ];
        }

        // Insérer les matchs en une seule requête
        Matche::insert($matcheData);
    }
}
