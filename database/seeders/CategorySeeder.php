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
    public function run(): void
    {

        $category = Category::create(['name'=>'Carnations ']);
        $category = Category::create(['name'=>'Irises ']);
        $category = Category::create(['name'=>'Lavender ']);
        $category = Category::create(['name'=>'Rose ']);
        $category = Category::create(['name'=>'Tulip ']);
        $category = Category::create(['name'=>'Sunflower ']);

    }
}
