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
            [
                'name' => 'Conciertos',
                'description' => 'Eventos musicales en vivo',
                'color' => '#8B5CF6'
            ],
            [
                'name' => 'Deportes',
                'description' => 'Eventos deportivos y competiciones',
                'color' => '#EF4444'
            ],
            [
                'name' => 'Teatro',
                'description' => 'Obras de teatro y presentaciones artísticas',
                'color' => '#F59E0B'
            ],
            [
                'name' => 'Conferencias',
                'description' => 'Seminarios, charlas y eventos educativos',
                'color' => '#10B981'
            ],
            [
                'name' => 'Festivales',
                'description' => 'Festivales culturales y celebraciones',
                'color' => '#EC4899'
            ],
            [
                'name' => 'Networking',
                'description' => 'Eventos de networking y profesionales',
                'color' => '#06B6D4'
            ],
            [
                'name' => 'Gastronomía',
                'description' => 'Eventos culinarios y degustaciones',
                'color' => '#F97316'
            ],
            [
                'name' => 'Tecnología',
                'description' => 'Eventos tecnológicos y startups',
                'color' => '#6366F1'
            ],
            [
                'name' => 'Arte',
                'description' => 'Exposiciones de arte y galerías',
                'color' => '#84CC16'
            ],
            [
                'name' => 'Otros',
                'description' => 'Otros tipos de eventos',
                'color' => '#6B7280'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
