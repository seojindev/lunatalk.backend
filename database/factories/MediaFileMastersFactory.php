<?php

namespace Database\Factories;

use App\Models\MediaFileMasters;
use Illuminate\Database\Eloquent\Factories\Factory;
use Helper;

class MediaFileMastersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MediaFileMasters::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categorys = [
            'products' => [
                'rep',
                'detail',
            ],
            'edit' => [
                'main-top',
            ],
        ];

        $arrayMediaNames = array("products", "edit");
        $randMediaNameKey = array_rand($arrayMediaNames, 1);
        $randMediaName = $arrayMediaNames[$randMediaNameKey];
        $randCategoryKey = array_rand($categorys[$randMediaName], 1);


        $randCategory = $categorys[$randMediaName][$randCategoryKey];

        return [
            'media_name' => $randMediaName,
            'media_category' => $randCategory,
            'dest_path' => '/storage/'.$randMediaName.'/'.$randCategory.'/'.sha1(date("Ymd")),
            'file_name' => Helper::uuidSecure().'.jpeg',
            'original_name' => 'test.jpeg',
            'width' => 500,
            'height' => 500,
            'file_type' => 'image/jpeg',
            'file_size' => '106639',

            'file_extension' => 'jpeg',
        ];
    }
}
