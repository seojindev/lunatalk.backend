<?php

namespace App\Http\Services;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use App\Http\Repositories\Eloquent\MainSlideMastersRepository;
use App\Http\Repositories\Eloquent\MainSlidesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminPageManageServices
{
    /**
     * @var Request
     */
    protected Request $currentRequest;

    protected MainSlideMastersRepository $mainSlideMastersReposity;

    function __construct(Request $request,  MainSlideMastersRepository $mainSlideMastersRepository)
    {
        $this->currentRequest = $request;
        $this->mainSlideMastersReposity = $mainSlideMastersRepository;
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    public function mainSlideValidator()
    {
         return Validator::make($this->currentRequest->all(), [
            'name' => 'required|string|min:1',
            'active' => 'required|in:Y,N|max:1',
            'media_id' => 'required|integer|exists:media_file_masters,id',
            'product_id' => 'integer|exists:media_file_masters,id',
        ],
            [
                'name.required'=> __('admin-page-manage.main-slide.name.required'),
                'active.required'=> __('admin-page-manage.main-slide.active.required'),
                'active.in'=> __('admin-page-manage.main-slide.active.in'),
                'media_id.required'=> __('admin-page-manage.main-slide.media_id.required'),
                'media_id.integer'=> __('admin-page-manage.main-slide.media_id.integer'),
                'media_id.exists'=> __('admin-page-manage.main-slide.media_id.exists'),
                'product_id.integer'=> __('admin-page-manage.main-slide.product_id.integer'),
                'product_id.exists'=> __('admin-page-manage.main-slide.product_id.exists'),
            ]);
    }

    /**
     * @return array
     * @throws ClientErrorException
     */
    public function createMainSlide() : array
    {
         $validator = $this->mainSlideValidator();

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $task = $this->mainSlideMastersReposity->create([
            'uuid' => Str::uuid(),
            'name' => $this->currentRequest->input('name'),
            'media_id' => $this->currentRequest->input('media_id'),
            'product_id' => $this->currentRequest->input('product_id'),
            'link' => $this->currentRequest->input('link'),
            'memo' => $this->currentRequest->input('memo'),
            'active' => $this->currentRequest->input('active'),
        ]);

        return [
            'uuid' => $task->uuid
        ];
    }

    /**
     * @param string $mainSlideUUID
     * @throws ClientErrorException
     */
    public function updateMainSlide(string $mainSlideUUID) : void
    {
        $mainSlide = $this->mainSlideMastersReposity->defaultCustomFind('uuid', $mainSlideUUID);

        $validator = $this->mainSlideValidator();

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $this->mainSlideMastersReposity->update($mainSlide->id, [
            'name' => $this->currentRequest->input('name'),
            'media_id' => $this->currentRequest->input('media_id'),
            'product_id' => $this->currentRequest->input('product_id'),
            'link' => $this->currentRequest->input('link'),
            'memo' => $this->currentRequest->input('memo'),
            'active' => $this->currentRequest->input('active'),
        ]);
    }

    /**
     * @throws ClientErrorException
     */
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
        }
    }

    /**
     * @return array
     * @throws ClientErrorException
     */
    public function showMainSlide() : array
    {
        $task = $this->mainSlideMastersReposity->getAdminMainSlideMasters()->toArray();

        if(empty($task)) {
            throw new ClientErrorException(__('response.success_not_found'));
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

    /**
     * @param string $mainSlideUUID
     * @return array
     */
    public function detailMainSlide(string $mainSlideUUID) : array
    {
        $task = $this->mainSlideMastersReposity->getAdminDetailMainSlideMasters($mainSlideUUID)->toArray();
        return [
            'uuid' => $task['uuid'],
            'name' => $task['name'],
            'product_id' => $task['product_id'],
            'product_uuid' => $task['product']['uuid'],
            'product_name' => $task['product']['name'],
            'memo' => $task['memo'],
            'active' => $task['active'],
            'image' => [
                'id' => $task['image']['id'],
                'file_name' => $task['image']['file_name'],
                'url' => env('APP_MEDIA_URL') . $task['image']['dest_path'] . '/' . $task['image']['file_name']
            ],
        ];
    }
}
