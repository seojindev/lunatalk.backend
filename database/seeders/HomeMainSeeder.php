<?php

namespace Database\Seeders;

use App\Models\HomeMains;
use Illuminate\Database\Seeder;

class HomeMainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') == 'testing') {
            HomeMains::factory()->count(10)->create();
        }
    }
}
