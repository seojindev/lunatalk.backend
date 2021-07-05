<?php

namespace Database\Seeders;

use App\Models\MediaFiles;
use App\Models\ProductImages;
use App\Models\ProductOptions;
use App\Models\Products;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') == 'testing') {

            foreach (config('extract.productCategory') as $categoryItem):
                Products::factory(4)->create([
                    'category' => $categoryItem['code']
                ]);

                foreach (Products::where('category', $categoryItem['code'])->get()->toArray() as $product) :
                    ProductOptions::factory(1)->create([
                        'product_id' => $product['id']
                    ]);
                    ProductImages::factory(1)->create([
                        'product_id' => $product['id'],
                        'media_category' => config('extract.mediaCategory.repImage.code')
                    ]);
                    ProductImages::factory(3)->create([
                        'product_id' => $product['id'],
                        'media_category' => config('extract.mediaCategory.detailImage.code')
                    ]);
                endforeach;
            endforeach;

        }
    }
}
