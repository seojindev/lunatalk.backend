<?php

namespace App\Http\Services;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use App\Http\Repositories\Eloquent\MainSlideMastersRepository;
use App\Http\Repositories\Eloquent\MainItemsRepository;
use App\Http\Repositories\Eloquent\ProductMastersRepository;
use App\Models\ProductMasters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminPageManageServices
{
    /**
     * @var Request
     */
    protected Request $currentRequest;

    /**
     * @var MainSlideMastersRepository
     */
    protected MainSlideMastersRepository $mainSlideMastersRepository;

    /**
     * @var MainItemsRepository
     */
    protected MainItemsRepository $mainItemsRepository;

    /**
     * @var ProductMastersRepository
     */
    protected ProductMastersRepository $productMastersRepository;

    /**
     * @param Request $request
     * @param MainSlideMastersRepository $mainSlideMastersRepository
     * @param MainItemsRepository $mainItemsRepository
     * @param ProductMastersRepository $productMastersRepository
     */
    function __construct(Request $request, MainSlideMastersRepository $mainSlideMastersRepository, MainItemsRepository $mainItemsRepository, ProductMastersRepository $productMastersRepository)
    {
        $this->currentRequest = $request;
        $this->mainSlideMastersRepository = $mainSlideMastersRepository;
        $this->mainItemsRepository = $mainItemsRepository;
        $this->productMastersRepository = $productMastersRepository;

    }

    /**
     * 메인 슬라이드 input 값 확인.
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
     * 메인 슬라이드 생성.
     * @return array
     * @throws ClientErrorException
     */
    public function createMainSlide() : array
    {
         $validator = $this->mainSlideValidator();

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $task = $this->mainSlideMastersRepository->create([
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
     * 메인 슬라이드 업데이트.
     * @param string $mainSlideUUID
     * @throws ClientErrorException
     */
    public function updateMainSlide(string $mainSlideUUID) : void
    {
        $mainSlide = $this->mainSlideMastersRepository->defaultCustomFind('uuid', $mainSlideUUID);

        $validator = $this->mainSlideValidator();

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $this->mainSlideMastersRepository->update($mainSlide->id, [
            'name' => $this->currentRequest->input('name'),
            'media_id' => $this->currentRequest->input('media_id'),
            'product_id' => $this->currentRequest->input('product_id'),
            'link' => $this->currentRequest->input('link'),
            'memo' => $this->currentRequest->input('memo'),
            'active' => $this->currentRequest->input('active'),
        ]);
    }

    /**
     * 메인 슬라이드 삭제.
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
            $mainSlide = $this->mainSlideMastersRepository->defaultCustomFind('uuid', $uuid);
            $this->mainSlideMastersRepository->deleteById($mainSlide->id);
        }
    }

    /**
     * 메인 슬라이드 리스트.
     * @return array
     * @throws ClientErrorException
     */
    public function showMainSlide() : array
    {
        $task = $this->mainSlideMastersRepository->getAdminMainSlideMasters()->toArray();

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
     * 메인 슬라이드 상세.
     * @param string $mainSlideUUID
     * @return array
     */
    public function detailMainSlide(string $mainSlideUUID) : array
    {
        $task = $this->mainSlideMastersRepository->getAdminDetailMainSlideMasters($mainSlideUUID)->toArray();
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

    /**
     * 메인 베스트 아이템 추가
     * @param String $uuid
     * @return array
     * @throws ClientErrorException
     */
    public function createBestItem(String $uuid) : array {

        $productTask = $this->productMastersRepository->defaultCustomFind('uuid', $uuid);

        $checkTask = $this->mainItemsRepository->mainBestItemExits($productTask->id);

        if($checkTask) {
            throw new ClientErrorException('이미지 등록되어 있는 상품 입니다.');
        }

        $createTask = $this->mainItemsRepository->create([
            'uuid' => Str::uuid(),
            'category' => config('extract.main_item.bestItem.code'),
            'product_id' => $productTask->id
        ]);

        return [
            'uuid' => $createTask->uuid
        ];
    }

    /**
     * 메인 베스트 아이템 삭제.
     * @param String $uuid
     * @throws ClientErrorException
     */
    public function deleteBestItem(String $uuid) : void {

        $product = $this->productMastersRepository->defaultCustomFind('uuid' , $uuid);

        $checkTask = $this->mainItemsRepository->defaultExistsColumn('product_id', $product->id);

        if($checkTask === false) {
            throw new ClientErrorException('등록되어 있지 않은 상품 입니다.');
        }

        // FIXME: 추후 한번만 날리게 수정.
        $this->mainItemsRepository->mainBestItemForceDelete($product->id);
    }

    /**
     * 메인 베스트 아이템 리스트.
     * @return array
     */
    public function showBestItem() : array {
        return array_map(function($item) {
            return [
                'uuid' => $item['uuid'],
                'prodcut' => [
                    'uuid' => $item['product']['uuid']
                ]
            ];
        } , $this->mainItemsRepository->showMainBestItems());
    }

    /**
     * 메인 뉴 아이템 추가
     * @param String $uuid
     * @return array
     * @throws ClientErrorException
     */
    public function createNewItem(String $uuid) : array {

        $productTask = $this->productMastersRepository->defaultCustomFind('uuid', $uuid);

        $checkTask = $this->mainItemsRepository->mainNewItemExits($productTask->id);

        if($checkTask) {
            throw new ClientErrorException('이미지 등록되어 있는 상품 입니다.');
        }

        $createTask = $this->mainItemsRepository->create([
            'uuid' => Str::uuid(),
            'category' => config('extract.main_item.newItem.code'),
            'product_id' => $productTask->id
        ]);

        return [
            'uuid' => $createTask->uuid
        ];
    }

    /**
     * 메인 뉴 아이템 삭제
     * @param String $uuid
     * @throws ClientErrorException
     */
    public function deleteNewItem(String $uuid) : void {

        $product = $this->productMastersRepository->defaultCustomFind('uuid' , $uuid);

        $checkTask = $this->mainItemsRepository->defaultExistsColumn('product_id', $product->id);

        if($checkTask === false) {
            throw new ClientErrorException('등록되어 있지 않은 상품 입니다.');
        }

        $this->mainItemsRepository->mainNewItemForceDelete($product->id);
    }

    /**
     * 메인 뉴 아이템 리스트
     * @return array
     */
    public function showNewItem() : array {
        return array_map(function($item) {
            return [
                'uuid' => $item['uuid'],
                'prodcut' => [
                    'uuid' => $item['product']['uuid']
                ]
            ];
        } , $this->mainItemsRepository->showMainNewItems());
    }
}
