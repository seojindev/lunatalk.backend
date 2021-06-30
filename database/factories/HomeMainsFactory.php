<?php

namespace Database\Factories;

use App\Models\HomeMains;
use App\Models\MediaFiles;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomeMainsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HomeMains::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randProducts = Products::select()->inRandomOrder()->first();
        $randMediaFile = MediaFiles::select()->inRandomOrder()->first();

        $status = [
            'Y',
            'N',
        ];

        return [
            'product_id' => $randProducts->id,
            'media_id' => $randMediaFile->id,
            'status' => $status[array_rand($status, 1)],
        ];
    }
}
