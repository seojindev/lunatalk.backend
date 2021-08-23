<?php

namespace Database\Factories;

use App\Models\ProductCategories;
use App\Models\ProductColorOptions;
use App\Models\ProductMasters;
use App\Models\ProductOptionMasters;
use App\Models\ProductWirelessOptions;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductOptionMastersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductOptionMasters::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'product_id' => ProductMasters::select('id')->inRandomOrder()->first()->id,
            'color' => ProductColorOptions::select('id')->inRandomOrder()->first()->id,
            'wireless' => ProductWirelessOptions::select('id')->inRandomOrder()->first()->id,
            'active' => rand(0, 100) < 99 ? 'Y' : 'N'
        ];
    }
}
