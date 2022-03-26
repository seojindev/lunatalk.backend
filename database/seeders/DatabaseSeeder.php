<?php

namespace Database\Seeders;

use App\Models\ProductWirelessOptionMasters;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ProductColorOptionMastersSeeder::class,
            ProductCategoryMastersSeeder::class,
            ProductWirelessOptionMastersSeeder::class,
        ]);

        if(env('APP_ENV') == 'testing') {
            $this->call([
                TestAdminUserSeeder::class,
                TestUserSeeder::class,
                TestProductSeeder::class,
            ]);
        }
    }
}
