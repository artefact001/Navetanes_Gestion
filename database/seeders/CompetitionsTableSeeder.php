<?php

use Illuminate\Database\Seeder;
use App\Models\Competition;

class CompetitionsTableSeeder extends Seeder
{
    public function run()
    {
        Competition::truncate(); // Optionnel : Pour vider la table avant de remplir

        // Créer des compétitions
        Competition::insert([
            ['nom' => 'Championnat de Printemps', 'date_debut' => now(), 'date_fin' => now()->addMonths(3)],
            ['nom' => 'Coupe d’Été', 'date_debut' => now()->addMonths(4), 'date_fin' => now()->addMonths(6)],
            // Ajoutez d'autres compétitions si nécessaire
            ['nom' => 'Tournoi d’Automne', 'date_debut' => now()->addMonths(7), 'date_fin' => now()->addMonths(9)],
            ['nom' => 'Championnat d’Hiver', 'date_debut' => now()->addMonths(10), 'date_fin' => now()->addYear()],
        ]);
    }
}
