<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $titleFr = fake('fr_FR')->sentence(4);
        $titleEn = fake('en_US')->sentence(4);

        return [
            'title_fr'           => $titleFr,
            'title_en'           => $titleEn,
            'slug_fr'            => Str::slug($titleFr) . '-' . fake()->randomNumber(4),
            'slug_en'            => Str::slug($titleEn) . '-' . fake()->randomNumber(4),
            'content_fr'         => fake('fr_FR')->paragraphs(3, true),
            'content_en'         => fake('en_US')->paragraphs(3, true),
            'category_id'        => Category::inRandomOrder()->first()->id,
            'author_id'          => User::inRandomOrder()->first()->id,
            'statut'             => fake()->randomElement(['brouillon', 'publié', 'archivé']),
            'publication_date'   => fake()->dateTimeBetween('-6 months', 'now'),
            'seo_title_fr'       => $titleFr,
            'seo_title_en'       => $titleEn,
            'meta_description_fr'=> fake('fr_FR')->sentence(12),
            'meta_description_en'=> fake('en_US')->sentence(12),
        ];
    }
}
