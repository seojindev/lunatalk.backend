<?php

namespace Database\Factories;

use App\Models\OrderMasters;
use App\Models\ProductMasters;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => OrderMasters::select('id')->orderBy('id', 'desc')->first(),
            'product_id' => ProductMasters::select('id')->inRandomOrder()->first(),
            'price' => 19000
        ];
    }
}
