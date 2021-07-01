<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
use Helper;
use App\Models\Codes;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randCategory = Codes::select('code_id')->where('group_id', 'O10')->whereNotNull('code_id')->inRandomOrder()->first();

        return [
            'uuid' => Helper::randomNumberUUID(),
            'category' => $randCategory->code_id,
            'name' => $this->faker->unique()->word,
            'barcode' => $this->faker->unique()->randomNumber(),
            'price' => $this->faker->unique()->numberBetween(1000, 9000),
            'stock' => $this->faker->unique()->numberBetween(30, 100),
            'memo' => $this->faker->unique()->text(200),
            'sale' => 'Y',
            'active' => 'Y'
        ];
    }
}
