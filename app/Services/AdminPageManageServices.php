<?php

namespace App\Services;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use App\Repositories\Eloquent\MainSlideMastersRepository;
use App\Repositories\Eloquent\MainSlidesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminPageManageServices
{
    /**
     * @var Request
     */
    protected Request $currentRequest;

    protected MainSlideMastersRepository $mainSlideMastersReposity;

    protected MainSlidesRepository $mainSlidesReposity;

    /**
     * @param Request $request
     */
    function __construct(Request $request,  MainSlideMastersRepository $mainSlideMastersRepository, MainSlidesRepository $mainSlidesReposity)
    {
        $this->currentRequest = $request;
        $this->mainSlideMastersReposity = $mainSlideMastersRepository;
        $this->mainSlidesReposity = $mainSlidesReposity;
    }


    public function mainSlideValidator()
    {
        // dd($this->currentRequest->all());
         return Validator::make($this->currentRequest->all(), [
            'name' => 'required|string|min:1',
            'active' => 'required|in:Y,N|max:1',
            'main_slide' => 'required|array',
        ],
            [
                'name.required'=> __('page-manage.admin.main-slide.name.required'),
                'active.required'=> __('page-manage.admin.main-slide.active.required'),
                'active.in'=> __('page-manage.admin.main-slide.active.in'),
                'main_slide.*'=> __('page-manage.admin.main-slide.main_slide'),
            ]);
    }

    public function createMainSlide() : array
    {
         $validator = $this->mainSlideValidator();

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $createTask = $this->mainSlideMastersReposity->create([
            'name' => $this->currentRequest->input('name'),
            'active' => $this->currentRequest->input('active')
        ]);


        foreach ($this->currentRequest->input('main_slide') as $media) :
            $this->mainSlidesReposity->create([
                'main_slide_id' => $createTask->id,
                'media_id' => $media['id'],
                'link' => $media['link']
            ]);
        endforeach;


        return [
            'uuid' => $createTask->uuid
        ];
    }

    public function showMainSlide() : array
    {
        $task = $this->mainSlideMastersReposity->getAdminMainSlideMasters()->toArray();

        if(empty($task)) {
            throw new ServiceErrorException(__('response.success_not_found'));
        }

       return array_map(function ($item) {
            return [
                'id' => $item['id'],
                'uuid' => $item['uuid'],
                'name' => $item['name'],
                'active' => $item['active']
            ];
       },$task);
    }

    public function detailMainSlide(string $mainSlideUUID) : array
    {
        $task = $this->mainSlideMastersReposity->getAdminDetailMainSlideMasters($mainSlideUUID)->toArray();
        return [
            'uuid' => $task['uuid'],
            'name' => $task['name'],
            'active' => $task['active'],
            'image' => array_map(function($item) {
              return [
                  'id' => $item['id'],
                  'link' => $item['link'],
                  'active' => $item['active'],
                  'file_name' => $item['image']['file_name'],
                  'url' => env('APP_MEDIA_URL') . $item['image']['dest_path'] . '/' . $item['image']['file_name']
              ];
            },$task['image']),
        ];
    }

    public function updateMainSlide(string $mainSlideUUID) : void
    {
        $mainSlide = $this->mainSlideMastersReposity->defaultCustomFind('uuid', $mainSlideUUID);

        $validator = $this->mainSlideValidator();

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }
        $this->mainSlideMastersReposity->update($mainSlide->id, [
            'name' => $this->currentRequest->input('name'),
            'active' => $this->currentRequest->input('active')
        ]);

        // 기존 이미지 삭제.
        $this->mainSlidesReposity->deleteByCustomColumn('main_slide_id',$mainSlide->id);

        foreach ($this->currentRequest->input('main_slide') as $media) :
            $this->mainSlidesReposity->create([
                'main_slide_id' => $mainSlide->id,
                'media_id' => $media['id'],
                'link' => $media['link']
            ]);
        endforeach;
    }

    public function deleteMainSlides() : void
    {
        $validator = Validator::make($this->currentRequest->all(), [
            'uuid' => 'required|array|min:1',
            'uuid.*' => 'exists:main_slide_masters,uuid'
        ],
            [
                'uuid.required' => __('page-manage.admin.main-slide.uuid.required'),
                'uuid.array' => __('page-manage.admin.main-slide.uuid.array'),
                'uuid.*.exists' => __('page-manage.admin.main-slide.uuid.exists'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        foreach ($this->currentRequest->input('uuid') as $uuid) {
            $mainSlide = $this->mainSlideMastersReposity->defaultCustomFind('uuid', $uuid);
            $this->mainSlideMastersReposity->deleteById($mainSlide->id);
            $this->mainSlidesReposity->deleteByCustomColumn('main_slide_id', $mainSlide->id);
        }
    }
}
