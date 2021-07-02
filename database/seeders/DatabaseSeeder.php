<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            CodesSeeder::class,
            UserSeeder::class,
            UserPhoneVerifySeeder::class,
            MediaFilesSeeder::class,
            ProductsSeeder::class,
            ProductOptionsSeeder::class,
            ProductImagesSeeder::class,
            HomeMainSeeder::class,
        ]);
    }
}
