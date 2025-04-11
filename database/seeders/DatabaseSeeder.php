<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //SEEDERS USUARIO
        User::factory()->create([
            'name' => 'Orlando Pérez',
            'email' => 'orlape@outlook.com',
            'password' => '12345678',
            'user_type' => '1', //USER
        ]);

        User::factory()->create([
            'name' => 'Jesús Ballester',
            'email' => 'jesusmaballester@gmail.com',
            'password' => '12345678',
            'user_type' => '2', //ADMIN
        ]);


        //LLAMADA A SEEDERS
        $this->call([
            CategorySeeder::class,
            AuthorSeeder::class,
            ProductSeeder::class,
        ]);



    }
}
