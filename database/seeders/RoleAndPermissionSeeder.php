<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer une permission
        Permission::create(['name' => 'gérer les formations']);
        Permission::create(['name' => 'gérer les sessions']);
        Permission::create(['name' => 'gérer les utilisateurs']);
        Permission::create(['name' => 'gérer les catégories']);
        Permission::create(['name' => 'publier une formation']);
        Permission::create(['name' => 'gérer les inscriptions']);
        Permission::create(['name' => 'voir le tableau de bord']);
        Permission::create(['name' => 'gérer le blog']);
        Permission::create(['name' => 'consulter les rapports']);

        // Créer un rôle
        $admin = Role::create(['name' => 'admin']);
        $formateur = Role::create(['name' => 'formateur']);
        $super_admin = Role::create(['name' => 'super_admin']);
        $participant = Role::create(['name' => 'participant']);

        // Assigner des permissions à un rôle
        $admin->givePermissionTo(['gérer les formations', 'gérer les sessions', 'gérer les utilisateurs', 'gérer les catégories', 'gérer les inscriptions', 'voir le tableau de bord', 'gérer le blog', 'consulter les rapports','publier une formation']);
        $super_admin->givePermissionTo(Permission::all());
        $formateur->givePermissionTo(['voir le tableau de bord','gérer les sessions']);
        $participant->givePermissionTo(['voir le tableau de bord']);
    }
}
