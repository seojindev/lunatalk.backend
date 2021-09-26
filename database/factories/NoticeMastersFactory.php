<?php

namespace Database\Factories;

use App\Models\Codes;
use App\Models\NoticeMasters;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoticeMastersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NoticeMasters::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {

        $category = Codes::select('code_id')->whereNotNull('code_id')->where('group_id', '220')->inRandomOrder()->first()->code_id;

        return [
            'category' => $category,
            'title' => $this->faker->unique()->word(),
            'content' => $this->faker->unique()->text(200),
            'active' => 'Y'
        ];
    }
}
