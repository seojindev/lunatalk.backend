<?php

namespace Database\Seeders;

use App\Models\ProductWirelessOptions;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductWirelessOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductWirelessOptions::truncate();

        DB::table('product_wireless_options')->insert([
            'wireless' => 'Y',
            'active' => 'Y',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('product_wireless_options')->insert([
            'wireless' => 'N',
            'active' => 'Y',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
