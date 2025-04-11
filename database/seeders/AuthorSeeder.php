<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Author::create(['name' => 'Editorial', 'lastname' => 'Redención']);
        \App\Models\Author::create(['name' => 'Antoine', 'lastname' => 'de Saint-Exupéry']);
        \App\Models\Author::create(['name' => 'Naira', 'lastname' => 'Gamboa']);
        \App\Models\Author::create(['name' => 'José Enrique', 'lastname' => 'Serrano Expósito']);
        \App\Models\Author::create(['name' => 'Lucía R.', 'lastname' => 'Jiménez']);
        \App\Models\Author::create(['name' => 'Gabriel M.', 'lastname' => 'Valero']);
        \App\Models\Author::create(['name' => 'Magdalena', 'lastname' => 'Latapi']);
        \App\Models\Author::create(['name' => 'Lewis', 'lastname' => 'Carroll']);
        \App\Models\Author::create(['name' => 'Jesús', 'lastname' => 'Ballester']);


        Author::factory(10)->create();
    }
}
