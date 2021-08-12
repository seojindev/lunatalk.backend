<?php

namespace Database\Factories;

use App\Models\MediaFiles;
use App\Models\ProductBadgeMasters;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductBadgeMastersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductBadgeMasters::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'media_id' => MediaFiles::select('id')->inRandomOrder()->first()->id,
            'active' => rand(0, 100) < 99 ? 'Y' : 'N'
        ];
    }
}
