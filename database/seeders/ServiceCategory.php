<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceCategory = [];
        for ($i = 0; $i < 10; $i++) {
            $serviceCategory[] = [
                'name' => 'Category '.$i,
                'description' => fake()->text(200),
                'created_at' => fake()->dateTime(),
                'updated_at' => fake()->dateTime(),
            ];
        }

        DB::table('service_categories')->insert($serviceCategory);
    }
}
