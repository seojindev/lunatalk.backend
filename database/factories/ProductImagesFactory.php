<?php

namespace Database\Factories;

use App\Models\Codes;
use App\Models\MediaFiles;
use App\Models\ProductImages;
use App\Models\Products;
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
        $product =  Products::select()->inRandomOrder()->first();
        $randMediaCategory = Codes::select('code_id')->where('group_id', 'G01')->whereNotNull('code_id')->inRandomOrder()->first();
        $randMediaId =  MediaFiles::select()->inRandomOrder()->first();

        return [
            'product_id' => $product->id,
            'media_category' => $randMediaCategory->code_id,
            'media_id' => $randMediaId->id
        ];
    }
}
