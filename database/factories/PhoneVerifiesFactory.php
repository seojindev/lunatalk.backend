<?php

namespace Database\Factories;

use App\Models\PhoneVerifies;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Helper;
use Crypt;

class PhoneVerifiesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhoneVerifies::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::select('id')->inRandomOrder()->first(),
            'phone_number' => Crypt::encryptString($this->faker->phoneNumber()),
            'auth_code' => Helper::generateAuthNumberCode(),
            'verified' => rand(0, 5) < 5 ? 'Y' : 'N',
        ];
    }
}
