<?php

namespace Database\Factories;

use App\Models\ProductBadgeMasters;
use App\Models\ProductBadges;
use App\Models\ProductMasters;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductBadgesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductBadges::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => ProductMasters::select('id')->inRandomOrder()->first()->id,
            'badge_id' => ProductBadgeMasters::select('id')->inRandomOrder()->first()->id,
            'active' => rand(0, 100) < 99 ? 'Y' : 'N'
        ];
    }
}
