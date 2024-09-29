<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreScheduleleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\StoreSchedule::factory(10)->create();
    }
}
