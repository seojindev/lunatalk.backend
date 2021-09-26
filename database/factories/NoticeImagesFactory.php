<?php

namespace Database\Factories;

use App\Models\MediaFileMasters;
use App\Models\NoticeImages;
use App\Models\NoticeMasters;
use Helper;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoticeImagesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NoticeImages::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $taskNotice = NoticeMasters::factory()->create();
        $taskImage = MediaFileMasters::factory()->create([
            'media_name' => 'manage',
            'media_category' => 'notice',
            'dest_path' => '/storage/manage/'.'/notice/'.sha1(date("Ymd")),
            'file_name' => Helper::uuidSecure().'.jpeg',
            'original_name' => Helper::uuidSecure().'.jpeg',
            'width' => '500',
            'height' => '500',
            'file_type' => 'image/jpeg',
            'file_size' => '106639',
            'file_extension' => 'jpeg',
        ]);
        return [
            'notice_id' => $taskNotice->id,
            'media_id' => $taskImage->id,
            'active' => 'Y',
        ];
    }
}
