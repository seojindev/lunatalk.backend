<?php

namespace Database\Seeders;

use App\Models\ProductCategories;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductCategories::truncate();

        $Categories = [
            'acc',
            'bag',
            'stationery',
            'wallet'
        ];
        foreach ($Categories as $category) :
            DB::table('product_categories')->insert([
                'name' => $category,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        endforeach;

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
