<?php

namespace Database\Factories;

use App\Models\OrderMasters;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderAddressFactory extends Factory
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
            'zipcode' => '11111',
            'step1' => $this->faker->text(50),
            'step2' => $this->faker->text(10),
        ];
    }
}
