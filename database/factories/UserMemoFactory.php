<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserMemo;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserMemoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserMemo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->take(1)->get()->first()->id,
            'memo' => $this->faker->text(),
        ];
    }
}
