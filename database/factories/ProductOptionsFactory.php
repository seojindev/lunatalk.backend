<?php

namespace Database\Factories;

use App\Models\Codes;
use App\Models\ProductOptions;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductOptionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductOptions::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product =  Products::select()->inRandomOrder()->first();
        $randStep1 = Codes::select('code_id')->where('group_id', 'O10')->whereNotNull('code_id')->inRandomOrder()->first();

        $randNumForStep2 = mt_rand(0, 1);

        if($randNumForStep2 == 0) {
            $randStep2 = null;
        } else {
            $randStep2 = Codes::select('code_id')->where('group_id', 'O20')->whereNotNull('code_id')->inRandomOrder()->first()->code_id;
        }

        return [
            'product_id' => $product->id,
            'step1' => $randStep1->code_id,
            'step2' => $randStep2
        ];
    }
}
