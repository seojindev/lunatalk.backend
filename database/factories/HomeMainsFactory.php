<?php

namespace Database\Factories;

use App\Models\HomeMains;
use App\Models\MediaFiles;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Codes;
use Helper;

/**
 * Class HomeMainsFactory
 * @package Database\Factories
 */
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
        $randGubun = Codes::select('code_id')->where('group_id', 'P10')->whereNotNull('code_id')->inRandomOrder()->first();
        $randProducts = Products::select()->inRandomOrder()->first();
        $randMediaFile = MediaFiles::select()->inRandomOrder()->first();

        return [
            'uid' => Helper::generateDigit(),
            'gubun' => $randGubun->code_id,
            'product_id' => $randProducts->id,
            'media_id' => $randMediaFile->id,
            'status' => 'Y',
        ];
    }
}
