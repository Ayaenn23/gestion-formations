<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Aya',
            'email' => 'aya@example.com',
            'password' => bcrypt('password'),
            'is_active' => true,
            'language' => 'fr',
        ]);
        $user->assignRole('super_admin');

        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_active' => true,
            'language' => 'fr',
        ]);
        $admin->assignRole('super_admin');

        $formateur = User::create([
            'name' => 'Formateur Test',
            'email' => 'formateur@example.com',
            'password' => bcrypt('password'),
            'is_active' => true,
            'language' => 'fr',
        ]);
        $formateur->assignRole('formateur');

        $participant = User::create([
            'name' => 'Participant Test',
            'email' => 'participant@example.com',
            'password' => bcrypt('password'),
            'is_active' => true,
            'language' => 'fr',
        ]);
        $participant->assignRole('participant');
    }
}
