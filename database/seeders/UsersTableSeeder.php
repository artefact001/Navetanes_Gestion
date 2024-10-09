<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Vider la table des utilisateurs avant de remplir (optionnel)
        User::truncate();

        // Créer un utilisateur administrateur
        $admin = User::create([
            'nom' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Ne jamais stocker des mots de passe en clair
        ]);
        $admin->assignRole('admin'); // Assigner le rôle d'administrateur

        // Créer 10 utilisateurs
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'nom' => 'User ' . $i,
                'email' => 'user' . $i .' @example.com',
                'password' => bcrypt('password'),
            ]);
            $user->assignRole('joueur'); // Assigner le rôle de joueur
        }
    }
}
