<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\ProCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'steps' => $this->faker->paragraph(),
            'etype' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced']),
            'image' => $this->faker->imageUrl(640, 480, 'sports', true, 'exercise'),
            'category_id' => Category::factory(),
            'pro_category_id' => ProCategory::factory(),
        ];
    }
}
