<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name_fr' => 'Développement Web', 'name_en' => 'Web Development', 'slug_fr' => 'developpement-web', 'slug_en' => 'web-development'],
            ['name_fr' => 'Data Science', 'name_en' => 'Data Science', 'slug_fr' => 'data-science', 'slug_en' => 'data-science'],
            ['name_fr' => 'Design Graphique', 'name_en' => 'Graphic Design', 'slug_fr' => 'design-graphique', 'slug_en' => 'graphic-design'],
            ['name_fr' => 'Marketing Digital', 'name_en' => 'Digital Marketing', 'slug_fr' => 'marketing-digital', 'slug_en' => 'digital-marketing'],
            ['name_fr' => 'Cybersécurité', 'name_en' => 'Cybersecurity', 'slug_fr' => 'cybersecurite', 'slug_en' => 'cybersecurity'],
        ];
        foreach ($categories as $category) {
            Category::create($category);


        }
    }
}
