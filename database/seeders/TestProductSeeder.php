<?php

namespace Database\Seeders;

use App\Models\MediaFileMasters;
use App\Models\ProductCategoryMasters;
use App\Models\ProductColorOptionMasters;
use App\Models\ProductImages;
use App\Models\ProductMasters;
use App\Models\ProductOptions;
use App\Models\ProductWirelessOptionMasters;
use Helper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TestProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repImage = $this->insertTestRepImage();
        $detailImage = $this->insertTestDetailImage();

        $productData = ProductMasters::factory()->create([
            "name" => "테스트 상품",
            'uuid' => Str::uuid(),
            "category" => ProductCategoryMasters::select('id')->inRandomOrder()->first()->id,
            "barcode" => 123123123,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "테스트 메모 입니다.",
            "sale" => "Y",
            "active" => "Y",
        ]);

        ProductOptions::factory()->create([
            'product_id' => $productData->id,
            'color' => ProductColorOptionMasters::select('id')->inRandomOrder()->first()->id,
            'wireless' => ProductWirelessOptionMasters::select('id')->inRandomOrder()->first()->id,
        ]);

        ProductImages::factory()->create([
            'product_id' => $productData->id,
            'media_category' => config('extract.mediaCategory.repImage.code'),
            'media_id' => $repImage->id,
            'active' => 'Y'
        ]);

        ProductImages::factory()->create([
            'product_id' => $productData->id,
            'media_category' => config('extract.mediaCategory.detailImage.code'),
            'media_id' => $detailImage->id,
            'active' => 'Y'
        ]);
    }

    public function insertTestRepImage() {
        return MediaFileMasters::factory()->create([
            'media_name' => 'products',
            'media_category' => 'rep',
            'dest_path' => '/storage/products/'.'/rep/'.sha1(date("Ymd")),
            'file_name' => Helper::uuidSecure().'.jpeg',
            'original_name' => Helper::uuidSecure().'.jpeg',
            'width' => '500',
            'height' => '500',
            'file_type' => 'image/jpeg',
            'file_size' => '106639',
            'file_extension' => 'jpeg',
        ]);
    }

    public function insertTestDetailImage() {
        return MediaFileMasters::factory()->create([
            'media_name' => 'products',
            'media_category' => 'detail',
            'dest_path' => '/storage/products/'.'/rep/'.sha1(date("Ymd")),
            'file_name' => Helper::uuidSecure().'.jpeg',
            'original_name' => Helper::uuidSecure().'.jpeg',
            'width' => '500',
            'height' => '500',
            'file_type' => 'image/jpeg',
            'file_size' => '106639',
            'file_extension' => 'jpeg',
        ]);
    }
}
