<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'title' => $this->faker->words(2, true),
            'function' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(3),
            'steps' => $this->faker->paragraph(2),
            'image' => $this->faker->imageUrl(400, 400, 'fitness', true),
        ];
    }
}
