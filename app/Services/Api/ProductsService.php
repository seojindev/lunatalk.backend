<?php


namespace App\Services\Api;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServerErrorException;
use Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Repositories\ProductsRepository;
use App\Repositories\ServiceRepository;

/**
 * Class ProductsService
 * @package App\Services\Api
 */
class ProductsService
{
    /**
     * @var ProductsRepository
     */
    protected ProductsRepository $productsRepository;

    /**
     * @var ServiceRepository
     */
    protected ServiceRepository $serviceRepository;

    /**
     * ProductsService constructor.
     * @param ProductsRepository $productsRepository
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(ProductsRepository $productsRepository, ServiceRepository $serviceRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * 상품 등록 수정 벨리데이션 처리.
     * @param Request $request
     * @return bool
     * @throws ClientErrorException
     */
    static function productValidation(Request $request) : bool
    {
        $validator = Validator::make($request->all(), [
            'product_category' => 'required|exists:codes,code_id',
            'product_name' => 'required|string|min:1',
            'product_option_step1' => 'required|exists:codes,code_id',
            'product_option_step2' => 'nullable|exists:codes,code_id',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|numeric',
//            'product_barcode' => 'nullable|string',
            'product_sale' => 'required|in:Y,N',
            'product_active' => 'required|in:Y,N|max:1',
            'product_image' => 'required',
            'product_image.*' => 'integer|exists:media_files,id',
            'product_detail_image' => 'required',
            'product_detail_image.*' => 'integer|numeric|exists:media_files,id',
        ],
            [
                'product_category.required'=> __('message.product.create.category.required'),
                'product_category.exists'=> __('message.product.create.category.exists'),
                'product_name.required'=> __('message.product.create.name.required'),
                'product_option_step1.required'=> __('message.product.create.option_step1.required'),
                'product_option_step1.exists'=> __('message.product.create.option_step1.exists'),
                'product_option_step2.exists'=> __('message.product.create.option_step2.exists'),
                'product_price.required'=> __('message.product.create.price.required'),
                'product_price.numeric'=> __('message.product.create.price.numeric'),
                'product_stock.required'=> __('message.product.create.stock.required'),
                'product_stock.numeric'=> __('message.product.create.stock.numeric'),
//            'product_barcode.required'=> __('message.product.create.tags_required'),
                'product_sale.required'=> __('message.product.create.sale.required'),
                'product_sale.in'=> __('message.product.create.sale.in'),
                'product_active.required'=> __('message.product.create.active.required'),
                'product_active.in'=> __('message.product.create.active.in'),
                'product_image.required'=> __('message.product.create.image.required'),
                'product_image.numeric'=> __('message.product.create.image.numeric'),
                'product_image.*.exists'=> __('message.product.create.image.exists'),
                'product_detail_image.required'=> __('message.product.create.detail.required'),
                'product_detail_image.numeric'=> __('message.product.create.detail.numeric'),
                'product_detail_image.*.exists'=> __('message.product.create.detail.exists'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        return true;
    }

    /**
     * 삼풍 등록 처리.
     * @param Request $request
     * @throws ClientErrorException
     */
    public function productCreate(Request $request) : void
    {
        self::productValidation($request);

        $createTask = $this->productsRepository->createProduct([
            'uuid' => Helper::randomNumberUUID(),
            'category' => $request->input('product_category'),
            'name' => $request->input('product_name'),
            'barcode' => $request->input('product_barcode'),
            'price' => $request->input('product_price'),
            'stock' => $request->input('product_stock'),
            'memo' => $request->input('product_memo'),
            'sale' => $request->input('product_sale'),
            'active' => $request->input('product_active')
        ]);

        $this->productsRepository->createProductOption([
            'product_id' => $createTask->id,
            'step1' => $request->input('product_option_step1'),
            'step2' => $request->input('product_option_step2')
        ]);

        // insert 가 시간은 뺴멱고 등록 처리 해서 create 로 변경.
        foreach ($request->input('product_image') as $element) :
            $this->productsRepository->createProductImage([
                'product_id' => $createTask->id,
                'media_category' => "G010010",
                'media_id' => $element,
            ]);
        endforeach;

        foreach ($request->input('product_detail_image') as $element) :
            $this->productsRepository->createProductImage([
                'product_id' => $createTask->id,
                'media_category' => "G010020",
                'media_id' => $element,
            ]);
        endforeach;
    }

    /**
     * 상품 업데이트 처리.
     * @param Request $request
     * @param String $uuid
     * @throws ClientErrorException
     */
    public function productUpdate(Request $request, String $uuid) : void
    {
        $productInfo = $this->productsRepository->productExitsByUUID($uuid);

        if(!$productInfo) {
            throw new ModelNotFoundException();
        }

        self::productValidation($request);

        $this->productsRepository->updateProduct($productInfo->id, [
            'category' => $request->input('product_category'),
            'name' => $request->input('product_name'),
            'barcode' => $request->input('product_barcode'),
            'price' => $request->input('product_price'),
            'stock' => $request->input('product_stock'),
            'memo' => $request->input('product_memo'),
            'sale' => $request->input('product_sale'),
            'active' => $request->input('product_active')
        ]);

        // 옵션 삭제 후 다시 등록.
        $this->productsRepository->deleteProductOptins($productInfo->id);
        $this->productsRepository->createProductOption([
            'product_id' => $productInfo->id,
            'step1' => $request->input('product_option_step1'),
            'step2' => $request->input('product_option_step2'),
        ]);

        // 업데이트시 일단 이미지를 삭제후 등록.
        $this->productsRepository->deleteProdctImages($productInfo->id);
        foreach ($request->input('product_image') as $element) :
            $this->productsRepository->createProductImage([
                'product_id' => $productInfo->id,
                'media_category' => "G010010",
                'media_id' => $element,
            ]);
        endforeach;

        foreach ($request->input('product_detail_image') as $element) :
            $this->productsRepository->createProductImage([
                'product_id' => $productInfo->id,
                'media_category' => "G010020",
                'media_id' => $element,
            ]);
        endforeach;
    }

    /**
     * 홈 메인 TOP 리스트 생성.
     * @return array
     */
    public function tabMainTopItems() : array
    {
        $task = $this->productsRepository->selectHomeMainTops()->get()->toArray();

        if(empty($task)) {
            throw new ModelNotFoundException();
        }

        return array_map(function($item) {
            return [
                'click_code' => $item['uid'],
                'product_name' => $item['product']['name'],
                'product_uuid' => $item['product']['uuid'],
                'product_image' => env('APP_MEDIA_URL') . $item['media_file']['dest_path'] . '/' . $item['media_file']['file_name']
            ];
         } , $task);
    }

    /**
     * 홈 카테고리 생성.
     * @return array
     */
    public function tabMainProductsCategoryItems() : array
    {
        return array_map(function($category) {
            $getTask = $this->productsRepository->selectProductCategoryRandomItem($category['code'])->toArray();
            return [
                'click_code' => $category['code'],
                'product_uuid' => $getTask['uuid'],
                'product_name' => $getTask['name'],
                'product_image' => env('APP_MEDIA_URL') . $getTask['rep_image']['mediafile']['dest_path'] . '/' . $getTask['rep_image']['mediafile']['file_name'],
                'product_thumb_image' => env('APP_MEDIA_URL') . $getTask['rep_image']['mediafile']['dest_path'] . '/thum_' . $getTask['rep_image']['mediafile']['file_name'],
            ];
        }, config('extract.productCategory'));
    }

    /**
     * 홈 베스트 아이템 생성.
     * @return array
     */
    public function tabMainProductsBestItems() : array
    {
        $getTask = $this->productsRepository->selectHomeMainBestItems()->get()->toArray();

        if(empty($getTask)) {
            throw new ModelNotFoundException();
        }

        return array_map(function($item) {
            return [
                'click_code' => $item['uid'],
                'product_name' => $item['product']['name'],
                'product_uuid' => $item['product']['uuid'],
                'product_image' => env('APP_MEDIA_URL') . $item['product']['rep_image']['mediafile']['dest_path'] . '/' . $item['product']['rep_image']['mediafile']['file_name'],
            ];
        }, array_filter($getTask, fn($value) => $value['product']['rep_image']));
    }

    /**
     * 홈 핫 아이템 생성.
     * @return array
     */
    public function tabMainProductsHotItems() : array
    {
        return array_map(function($item) {
            return [
                'click_code' => $item['uid'],
                'product_name' => $item['product']['name'],
                'product_uuid' => $item['product']['uuid'],
                'product_image' => env('APP_MEDIA_URL') . $item['product']['rep_image']['mediafile']['dest_path'] . '/' . $item['product']['rep_image']['mediafile']['file_name'],
            ];
        } , $this->productsRepository->selectHomeMainHotItems()->get()->toArray());
    }

    /**
     * 전체 상품 리스트 - 페이징 처리.
     * @param Int $page
     * @return array
     */
    public function productsListPaging(Int $page = 1) : array
    {
        $task = collect($this->productsRepository->selectProductsTotalPaging($page))->toArray();
        $taskData = $task['data'];

        return [
            'current_page' => $task['current_page'],
            'per_page' => $task['per_page'],
            'has_more' => !((config('extract.default.list_pageing') > count($taskData))),
            'from' => $task['from'],
            'to' => $task['to'],
            'products' => array_map(function($item) {

                $optionStep1Name = $item['options']['step1']['code_name'];
                $optionStep2Name = !empty($item['options']['step2']) ? $item['options']['step2']['code_name'] : '';

                return [
                    'id' => $item['id'],
                    'uuid' => $item['uuid'],
                    'category' => [
                        'code_id' => $item['category']['code_id'],
                        'code_name' => $item['category']['code_name'],
                    ],
                    'name' => $item['name'],
                    'full_name' => $item['name'] . ' ' . $optionStep1Name . ' ' . $optionStep2Name,
                    'options' => [
                        'step1' => [
                            'code_id' => $item['options']['step1']['code_id'],
                            'name_name' => $item['options']['step1']['code_name'],
                        ],
                        'step2' => !empty($item['options']['step2']) ? [
                            'code_id' => $item['options']['step2']['code_id'],
                            'name_name' => $item['options']['step2']['code_name'],
                        ] : (object) []
                    ],
                    'rep_image' => [
                        'path' => $item['rep_image']['mediafile']['dest_path'] . '/' . $item['rep_image']['mediafile']['file_name'],
                        'url' => env('APP_MEDIA_URL') .  $item['rep_image']['mediafile']['dest_path'] . '/' . $item['rep_image']['mediafile']['file_name'],
                        'thumb_url' => env('APP_MEDIA_URL') . $item['rep_image']['mediafile']['dest_path'] . '/thum_' . $item['rep_image']['mediafile']['file_name']
                    ]
                ];
            }, $taskData),
        ];
    }
}
