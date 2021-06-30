<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MediaFiles;

class MediaFilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') == 'testing') {
            MediaFiles::factory()->count(5)->create();
        }
    }
}
