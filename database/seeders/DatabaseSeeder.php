<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StoreSeeder::class,
            StoreScheduleleSeed::class,
            UserSeeder::class,
            ServiceCategoriesTableSeeder::class,
            ServicesTableSeeder::class,
            InvoiceSeeder::class,
            BookingSeeder::class,
        ]);
    }
}
