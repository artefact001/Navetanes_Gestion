<?php

use Illuminate\Database\Seeder;
use App\Models\Equipe;
use App\Models\Zone;
use App\Models\User;

class EquipesTableSeeder extends Seeder
{
    public function run()
    {
        Equipe::truncate(); // Optionnel : Pour vider la table avant de remplir

        // Récupérer toutes les zones
        $zones = Zone::all();

        // Vérifier s'il y a des utilisateurs avec le rôle 'admin'
        $adminUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        if ($adminUsers->isEmpty()) {
            // Avertir si aucun utilisateur admin n'est trouvé
            $this->command->error("Aucun utilisateur avec le rôle 'admin' trouvé.");
            return; // Sortir si pas d'admins
        }

        // Créer des équipes pour chaque zone
        foreach ($zones as $zone) {
            for ($i = 1; $i <= 5; $i++) {
                Equipe::create([
                    'nom' => 'Équipe ' . $i . ' de ' . $zone->nom,
                    'logo' => 'path/to/logo_' . $i . '.png', // Assurez-vous que le chemin soit valide
                    'date_creer' => now(),
                    'zone_id' => $zone->id,
                    'user_id' => $adminUsers->random()->id, // Récupérer un admin au hasard
                ]);
            }
        }
    }
}
