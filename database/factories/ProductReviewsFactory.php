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
            'product_id' => ProductMasters::select('id')->inRandomOrder()->first()->id,
            'user_id' => User::select('id')->inRandomOrder()->first(),
            'title' => $this->faker->word(),
            'contents' => $this->faker->text(),
            'active' => rand(0,100) < 99 ? 'Y' : 'N'
        ];
    }
}
