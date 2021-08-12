<?php

namespace Database\Factories;

use App\Models\ProductMasters;
use App\Models\ProductReviews;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductReviewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductReviews::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_uuid' => ProductMasters::select('uuid')->inRandomOrder()->first()->uuid,
            'user_id' => User::select('id')->inRandomOrder()->first(),
            'contents' => $this->faker->text(),
            'active' => rand(0,100) < 99 ? 'Y' : 'N'
        ];
    }
}
