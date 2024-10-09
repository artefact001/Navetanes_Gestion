<?php

use Illuminate\Database\Seeder;
use App\Models\Zone;
use App\Models\User;

class ZonesTableSeeder extends Seeder
{
    public function run()
    {
        Zone::truncate(); // Optionnel : Pour vider la table avant de remplir

        // Récupérer un utilisateur admin
        $adminUser = User::where('role', 'admin')->first();

        // Créer des zones
        Zone::insert([
            ['nom' => 'Zone A', 'localite' => 'Localité A', 'user_id' => $adminUser->id],
            ['nom' => 'Zone B', 'localite' => 'Localité B', 'user_id' => $adminUser->id],
            // Ajoutez d'autres zones si nécessaire
        ]);
    }
}
