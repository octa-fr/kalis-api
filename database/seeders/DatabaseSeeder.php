<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\ProCategory;
use App\Models\Exercise;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $categories = Category::factory(5)->create();

        $proCategories = ProCategory::factory(3)->create();

        Exercise::factory(20)->create();
    }
}
