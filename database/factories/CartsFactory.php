<?php

namespace Database\Factories;

use App\Models\ProductMasters;
use App\Models\User;
use App\Models\Carts;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Carts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->get()->id,
            'product_id' => ProductMasters::inRandomOrder()->get()->id
        ];
    }
}
