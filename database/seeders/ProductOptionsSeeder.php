<?php

namespace Database\Seeders;

use App\Models\ProductOptions;
use Illuminate\Database\Seeder;

class ProductOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') == 'testing') {
            ProductOptions::factory()->count(50)->create();
        }
    }
}
