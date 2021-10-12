<?php

namespace App\Http\Services;

use App\Http\Repositories\Eloquent\MainSlideMastersRepository;
use App\Http\Repositories\Eloquent\MainSlidesRepository;

class FrontPageServices
{
    protected MainSlideMastersRepository $mainSlideMastersRepository;

    function __construct(MainSlideMastersRepository $mainSlideMastersRepository) {
        $this->mainSlideMastersRepository = $mainSlideMastersRepository;
    }

    public function mainSlide() : array {
        $task = $this->mainSlideMastersRepository->createMainSldesList();

        if(!$task) {
            return [];
        }

        return array_map(function($item) {
            return [
                'name' => $item['name'],
                'image' => [
                    'file_name' => $item['image']['image']['file_name'],
                    'url' => env('APP_MEDIA_URL') . '/' . $item['image']['image']['dest_path'] . '/' . $item['image']['image']['file_name'],
                    'width' => $item['image']['image']['width'],
                    'height' => $item['image']['image']['height'],
                ]
            ];
        } , $task->toArray());
    }


}
