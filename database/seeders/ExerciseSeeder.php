<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $i) {
            DB::table('exercise')->insert([
                'title' => $faker->sentence(3),
                'steps' => $faker->paragraph(2),
                'category' => $faker->randomElement(['lowerbody', 'upperbody', 'fullbody']),
                'pro_category' => $faker->randomElement(['pushday', 'pullday', 'legday',]),
                'image' => $faker->image('public/storage/exercise', 640, 480, null, false),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
