<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Product::factory()->create([
        //     'title' => 'Santa Biblia',
        //     'authors_id'=> 1,
        //     'category_id' => 1
        // ]);

        // Product::factory()->create([
        //     'title' => 'El Principito',
        //     'authors_id'=> 2,
        //     'category_id' => 2
        // ]);

        // Product::factory()->create([
        //     'title' => 'Cruce de Caminos',
        //     'authors_id'=> 3,
        //     'category_id' => 3
        // ]);

        // Product::factory()->create([
        //     'title' => 'El Bosque Mágico',
        //     'authors_id'=> 3,
        //     'category_id' => 4
        // ]);

        // Product::factory()->create([
        //     'title' => 'Atlantis: Proyecto Tarsis',
        //     'authors_id'=> 4,
        //     'category_id' => 4
        // ]);

        // Product::factory()->create([
        //     'title' => 'Abriendo Negocios',
        //     'authors_id'=> 5,
        //     'category_id' => 5
        // ]);

        // Product::factory()->create([
        //     'title' => 'El Laberinto de los Susurros',
        //     'authors_id'=> 6,
        //     'category_id' => 3
        // ]);

        // Product::factory()->create([
        //     'title' => 'Mamá nos dijo Adiós',
        //     'authors_id'=> 7,
        //     'category_id' => 3
        // ]);

        // Product::factory()->create([
        //     'title' => 'Alicia en el País de las Maravillas',
        //     'authors_id'=> 8,
        //     'category_id' => 4
        // ]);

        // Product::factory()->create([
        //     'title' => 'Chiguire Samurai',
        //     'authors_id'=> 9,
        //     'category_id' => 4
        // ]);

        Product::factory()
            ->count(50)
                ->create([
                    'authors_id' => Author::inRandomOrder()->first()->id,
                    'category_id' => Category::inRandomOrder()->first()->id
                ]);
    }
}
