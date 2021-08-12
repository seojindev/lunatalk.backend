<?php

namespace Database\Factories;

use App\Models\ProductCategories;
use App\Models\ProductMasters;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductMastersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductMasters::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category' => ProductCategories::select('id')->inRandomOrder()->first()->id,
            'name' => $this->faker->unique()->word(),
            'barcode' => $this->faker->unique()->randomNumber(),
            'price' => $this->faker->unique()->numberBetween(1000, 9000),
            'stock' => $this->faker->unique()->numberBetween(30, 100),
            'memo' => $this->faker->unique()->text(200),
            'sale' => 'Y',
            'active' => 'Y'
        ];
    }
}
