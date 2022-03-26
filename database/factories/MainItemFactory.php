<?php

namespace Database\Factories;

use App\Models\MainItem;
use App\Models\ProductMasters;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MainItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MainItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid(),
            'category' => config('extract.main_item.bestItem.code'),
            'product_id' => ProductMasters::inRandomOrder()->take(1)->get()->first()->id,
        ];
    }
}
