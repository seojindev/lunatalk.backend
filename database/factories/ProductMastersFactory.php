<?php

namespace Database\Factories;

use App\Models\ProductCategoryMasters;
use App\Models\ProductMasters;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'uuid' => Str::uuid(),
            'category' => ProductCategoryMasters::select('id')->inRandomOrder()->first()->id,
            'name' => $this->faker->unique()->word(),
            'barcode' => $this->faker->unique()->randomNumber(),
            'price' => $this->faker->unique()->numberBetween(1000, 9000),
            'quantity' => $this->faker->unique()->numberBetween(30, 100),
            'memo' => $this->faker->unique()->text(200),
            'sale' => 'Y',
            'active' => 'Y'
        ];
    }
}
