<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Supprimer tous les rôles et permissions précédents
        Role::truncate();
        Permission::truncate();

        // Créer des permissions
        $permissions = [
            'create equipes',
            'edit equipes',
            'delete equipes',
            'view equipes',
            'create joueurs',
            'edit joueurs',
            'delete joueurs',
            'view joueurs',
            'manage zones',
            'manage competitions',
            'view results',
        ];

        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Créer des rôles
        $roles = [
            'admin',
            'zone',
            'equipe',
            'joueur',
        ];

        foreach ($roles as $role) {
            if (!Role::where('name', $role)->exists()) {
                Role::create(['name' => $role]);
            }
        }

        // Assigner des permissions aux rôles
        $adminRole = Role::findByName('admin');
        $zoneRole = Role::findByName('zone');
        $equipeRole = Role::findByName('equipe');
        $joueurRole = Role::findByName('joueur');

        // Assigner toutes les permissions à l'admin
        $adminRole->givePermissionTo(Permission::all());

        // Assigner des permissions spécifiques à chaque rôle
        $zoneRole->givePermissionTo(['manage zones', 'view equipes']);
        $equipeRole->givePermissionTo(['create equipes', 'edit equipes', 'view equipes', 'manage competitions']);
        $joueurRole->givePermissionTo(['view joueurs', 'edit joueurs']);
    }
}
