<?php

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Categorie::truncate(); // Optionnel : Pour vider la table avant de remplir

        // Créer des catégories
        Categorie::insert([
            ['nom' => 'Junior'],
            ['nom' => 'Cadete'],
            // Ajoutez d'autres catégories si nécessaire
        ]);
    }
}
