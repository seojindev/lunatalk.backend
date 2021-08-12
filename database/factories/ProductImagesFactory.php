<?php

namespace Database\Factories;

use App\Models\Codes;
use App\Models\MediaFiles;
use App\Models\ProductImages;
use App\Models\ProductMasters;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImagesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductImages::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $media_category = "";

        $repImageCode = config('extract.mediaCategory.repImage.code');
        $thumbnailImageCode = config('extract.mediaCategory.thumbnailImage.code');
        $detailImageCode = config('extract.mediaCategory.detailImage.code');

        $randUUID = ProductMasters::select('uuid')->inRandomOrder()->first()->uuid;

        if(ProductImages::where([['product_uuid', $randUUID], ['media_category', $repImageCode]])->exists()) {
            $media_category = $repImageCode;
        } else {
            if(ProductImages::where([['product_uuid', $randUUID], ['media_category', $thumbnailImageCode]])->exists()) {
                $media_category = $detailImageCode;
            } else {
                $media_category = $thumbnailImageCode;
            }
        }

        return [
            'product_uuid' => ProductMasters::select('uuid')->inRandomOrder()->first()->uuid,
            'media_category' => $media_category,
            'media_id' => MediaFiles::select('id')->inRandomOrder()->first()->id,
            'active' => rand(0,100) < 99 ? 'Y' : 'N'
        ];
    }
}
