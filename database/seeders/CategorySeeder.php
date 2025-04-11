<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Category::create(['name' => 'Religión']);
        \App\Models\Category::create(['name' => 'Literatura Infantil']);
        \App\Models\Category::create(['name' => 'Reflexión']);
        \App\Models\Category::create(['name' => 'Fantasía']);
        \App\Models\Category::create(['name' => 'Negocios']);
    }
}
