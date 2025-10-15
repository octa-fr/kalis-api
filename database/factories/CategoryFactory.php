<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'type' => $this->faker->randomElement(['training', 'program']),
            'cate_image' => $this->faker->imageUrl(640, 480, 'sports', true),
        ];
    }
}

