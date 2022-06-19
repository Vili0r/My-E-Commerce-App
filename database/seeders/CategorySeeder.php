<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Men', 
            'slug' => 'men', 
            'description' => 'All products',
            'parent_id' => 0
        ]);
        Category::create([
            'name' => 'Women', 
            'slug' => 'women', 
            'description' => 'All products',
            'parent_id' => 0
        ]);
        Category::create([
            'name' => 'Kids', 
            'slug' => 'kid', 
            'description' => 'All products',
            'parent_id' => 0
        ]);
        Category::create([
            'name' => 'Trainers', 
            'slug' => 'trainers', 
            'description' => 'All products',
            'parent_id' => 1
        ]);
        Category::create([
            'name' => 'Nike', 
            'slug' => 'nike', 
            'description' => 'All products',
            'parent_id' => 4
        ]);
        Category::create([
            'name' => 'Air Max', 
            'slug' => 'air-max', 
            'description' => 'All products',
            'parent_id' => 5
        ]);
    }
}
