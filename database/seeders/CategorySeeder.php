<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Playa', 'description' => 'Paquetes para disfrutar del sol, el mar y la arena.'],
            ['name' => 'Montaña', 'description' => 'Paquetes para amantes de la naturaleza y el aire libre.'],
            ['name' => 'Ciudad', 'description' => 'Explora la cultura, historia y vida nocturna de las ciudades más vibrantes.'],
            ['name' => 'Aventura', 'description' => 'Para los que buscan adrenalina y experiencias únicas.'],
            ['name' => 'Cruceros', 'description' => 'Navega por los mares y descubre múltiples destinos.'],
            ['name' => 'Cultural', 'description' => 'Sumérgete en la historia y el arte de nuevos lugares.'],
            ['name' => 'Luna de Miel', 'description' => 'Destinos románticos para celebrar el amor.'],
            ['name' => 'Económicos', 'description' => 'Viaja más por menos con nuestros paquetes económicos.'],
        ];

        foreach ($categories as $categoryData) {
            Category::create([
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'description' => $categoryData['description'],
                'is_active' => true,
            ]);
        }
    }
}
