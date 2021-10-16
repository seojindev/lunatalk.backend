<?php

namespace Database\Seeders;

use App\Models\ProductCategoryMasters;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategoryMastersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') !== 'testing') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            ProductCategoryMasters::truncate();
        }

        $Categories = [
            'acc',
            'bag',
            'stationery',
            'wallet'
        ];
        foreach ($Categories as $category) :

            if (env('APP_ENV') == 'testing') {
                DB::table('product_category_masters')->insert([
                    'uuid' => Str::uuid(),
                    'name' => $category,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            } else {
                DB::table('product_category_masters')->insert([
                    'name' => $category,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        endforeach;

        if (env('APP_ENV') !== 'testing') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
