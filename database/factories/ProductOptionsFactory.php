<?php

namespace Database\Factories;

use App\Models\ProductCategoryMasters;
use App\Models\ProductColorOptionMasters;
use App\Models\ProductMasters;
use App\Models\ProductOptions;
use App\Models\ProductWirelessOptionMasters;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductOptionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductOptions::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'product_id' => ProductMasters::select('id')->inRandomOrder()->first()->id,
            'color' => ProductColorOptionMasters::select('id')->inRandomOrder()->first()->id,
            'wireless' => ProductWirelessOptionMasters::select('id')->inRandomOrder()->first()->id,
            'active' => rand(0, 100) < 99 ? 'Y' : 'N'
        ];
    }
}
