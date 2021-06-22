<?php

namespace Database\Factories;

use App\Models\UserPhoneVerify;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Helper;

class UserPhoneVerifyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserPhoneVerify::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::where('user_level', 'S020010')->inRandomOrder()->first()->id,
            'phone_number' => $this->faker->numerify('010-####-####'),
            'auth_code' => Helper::generateAuthNumberCode(),
            'verified_at' => Carbon::now(),
        ];
    }
}
