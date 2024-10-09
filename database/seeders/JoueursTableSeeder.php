<?php

use Illuminate\Database\Seeder;
use App\Models\Joueur;
use App\Models\Equipe;
use App\Models\Categorie; // Ajout de Categorie
use Faker\Factory as Faker;

class JoueursTableSeeder extends Seeder
{
    public function run()
    {
        Joueur::truncate(); // Optionnel : Pour vider la table avant de remplir

        $faker = Faker::create();

        // Créer des joueurs
        $equipes = Equipe::all();
        $categories = Categorie::all(); // Récupérer toutes les catégories

        foreach ($equipes as $equipe) {
            for ($i = 1; $i <= 10; $i++) {
                Joueur::create([
                    'nom' => $faker->name,
                    'age' => rand(15, 40), // Âge aléatoire entre 15 et 40
                    'licence' => $faker->unique()->numerify('LIC-#####'),
                    'equipe_id' => $equipe->id,
                    'categorie_id' => $categories->random()->id, // Assigner une catégorie aléatoire existante
                ]);
            }
        }
    }
}
