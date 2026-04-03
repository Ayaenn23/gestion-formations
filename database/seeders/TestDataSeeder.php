<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Enrollment;
use App\Models\Contact;
use App\Models\Formation;
use App\Models\TrainingSession;
use App\Models\Category;
use App\Enums\FormationStatus;
use App\Enums\SessionMode;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Formateurs
        $formateurs = User::factory(5)->create()->each(function ($user) {
            $user->assignRole('formateur');
        });

        // 2. Participants
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('participant');
        });

        // 3. Formations avec sessions (on crée manuellement car pas de FormationFactory)
        $categories = Category::all();

        foreach ($categories as $category) {
            $formation = Formation::create([
                'category_id'          => $category->id,
                'titre_fr'             => 'Formation ' . $category->name_fr,
                'titre_en'             => 'Training ' . $category->name_en,
                'description_courte_fr'=> 'Une formation en ' . $category->name_fr,
                'description_courte_en'=> 'A training in ' . $category->name_en,
                'prix'                 => fake()->randomElement([1200, 1500, 2000, 2500]),
                'duree'                => fake()->randomElement(['2 jours', '3 jours', '1 semaine']),
                'niveau'               => fake()->randomElement(['Débutant', 'Intermédiaire', 'Avancé']),
                'statut'               => FormationStatus::Publie->value,
                'date_publication'     => now(),
            ]);

            // 2 sessions par formation
            TrainingSession::create([
                'formation_id' => $formation->id,
                'trainer_id'   => $formateurs->random()->id,
                'start_date'   => now()->addDays(rand(5, 30)),
                'end_date'     => now()->addDays(rand(31, 60)),
                'capacity'     => 20,
                'mode'         => SessionMode::Presentiel->value,
                'ville'        => fake()->city(),
                'statut'       => 'planifiée',
            ]);

            TrainingSession::create([
                'formation_id' => $formation->id,
                'trainer_id'   => $formateurs->random()->id,
                'start_date'   => now()->addDays(rand(60, 90)),
                'end_date'     => now()->addDays(rand(91, 120)),
                'capacity'     => 15,
                'mode'         => SessionMode::EnLigne->value,
                'lien_reunion' => 'https://meet.example.com/' . fake()->slug(),
                'statut'       => 'planifiée',
            ]);
        }

        // 4. Articles de blog (maintenant que les users existent)
        Post::factory(15)->create();

        // 5. Inscriptions (maintenant que les sessions existent)
        Enrollment::factory(20)->create();

        // 6. Messages de contact
        Contact::factory(10)->create();
    }
}
