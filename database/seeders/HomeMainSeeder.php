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

            foreach (config('extract.homeMainGubun') as $gubun):
                $tmp_i = 0;
                while($tmp_i <= 3):
                    HomeMains::factory()->create([
                        'gubun' => $gubun['code']
                    ]);
                    $tmp_i++;
                endwhile;
            endforeach;
        }
    }
}
