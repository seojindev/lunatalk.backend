<?php

namespace Database\Factories;

use App\Models\ProductCategoryMasters;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductCategoryMasters::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word()
        ];
    }
}
