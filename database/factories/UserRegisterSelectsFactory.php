<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserRegisterSelects;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserRegisterSelectsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserRegisterSelects::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::select('id')->inRandomOrder()->first(),
            'email' => rand(0, 1) === 1 ? 'Y' : 'N',
            'message' => rand(0, 1) === 1 ? 'Y' : 'N',
        ];
    }
}
