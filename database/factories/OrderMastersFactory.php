<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderMastersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => \Helper::randomNumberUUID(),
            'user_id' => User::inRandomOrder()->get()->id,
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'message' => $this->faker->text(),
            'order_name' => $this->faker->word(),
            'order_price' => 19000,
            'active' => 'N'
        ];
    }
}
