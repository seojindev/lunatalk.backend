<?php

namespace Database\Seeders;

use App\Models\ProductImages;
use Illuminate\Database\Seeder;

class ProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') == 'testing') {
            ProductImages::factory()->count(50)->create();
        }
    }
}
