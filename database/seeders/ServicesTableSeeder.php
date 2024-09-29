<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Seed the services table.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $categoryIds = DB::table('service_categories')->pluck('id');

        foreach (range(1, 50) as $index) {
            DB::table('services')->insert([
                'category_id' => $faker->randomElement($categoryIds),
                'name' => $faker->word,
                'description' => $faker->paragraph,
                'duration' => $faker->numberBetween(30, 120), // Duration in minutes
                'price' => $faker->randomFloat(2, 10, 200), // Price between 10 and 200
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null, // For soft delete, this can be null
            ]);
        }
    }
}
