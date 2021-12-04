<?php

namespace App\Http\Services;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use App\Http\Repositories\Eloquent\MediaFileMastersRepository;
use App\Http\Repositories\Eloquent\ProductBadgeMastersRepository;
use App\Http\Repositories\Eloquent\ProductCategoryMastersRepository;
use App\Http\Repositories\Eloquent\ProductMastersRepository;
use App\Http\Repositories\Eloquent\ProductOptionsRepository;
use App\Http\Repositories\Eloquent\ProductImagesRepository;
use App\Http\Repositories\Eloquent\ProductReviewsRepository;
use App\Models\ProductBadgeMasters;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Str;

class AdminProductServices
{
    /**
     * @var Request
     */
    protected Request $currentRequest;

    /**
     * @var ProductCategoryMastersRepository
     */
    protected ProductCategoryMastersRepository $productCategoryMastersRepository;

    /**
     * @var ProductMastersRepository
     */
    protected ProductMastersRepository $productMastersRepository;

    /**
     * @var ProductOptionsRepository
     */
    protected ProductOptionsRepository $productOptionsRepository;

    /**
     * @var ProductImagesRepository
     */
    protected ProductImagesRepository $productImagesRepository;

    /**
     * @var ProductReviewsRepository
     */
    protected ProductReviewsRepository $productReviewsRepository;

    /**
     * @var MediaFileMastersRepository
     */
    protected MediaFileMastersRepository $mediaFileMastersRepository;

    protected ProductBadgeMastersRepository $productBadgeMastersRepository;


    /**
     * @param Request $request
     * @param MediaFileMastersRepository $mediaFileMastersRepository
     * @param ProductReviewsRepository $productReviewsRepository
     * @param ProductCategoryMastersRepository $productCategoryMastersRepository
     * @param ProductMastersRepository $productMastersRepository
     * @param ProductOptionsRepository $productOptionsRepository
     * @param ProductImagesRepository $productImagesRepository
     */
    function __construct(Request $request, ProductBadgeMastersRepository $productBadgeMastersRepository, MediaFileMastersRepository $mediaFileMastersRepository, ProductReviewsRepository $productReviewsRepository, ProductCategoryMastersRepository $productCategoryMastersRepository, ProductMastersRepository $productMastersRepository, ProductOptionsRepository $productOptionsRepository, ProductImagesRepository $productImagesRepository)
    {
        $this->currentRequest = $request;
        $this->productCategoryMastersRepository = $productCategoryMastersRepository;
        $this->productMastersRepository = $productMastersRepository;
        $this->productOptionsRepository = $productOptionsRepository;
        $this->productImagesRepository = $productImagesRepository;
        $this->productReviewsRepository = $productReviewsRepository;
        $this->mediaFileMastersRepository = $mediaFileMastersRepository;
        $this->productBadgeMastersRepository = $productBadgeMastersRepository;
    }

    /**
     * 상품 카테고리 벨리데이션.
     * @return array
     * @throws ClientErrorException
     */
    public function createProductCategotry() : array
    {
        $validator = Validator::make($this->currentRequest->all(), [
            'name' => 'required|unique:product_category_masters,name',
        ],
            [
                'name.required' => __('product.admin.create.name.required'),
                'name.unique' => __('product.admin.create.name.unique'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $task = $this->productCategoryMastersRepository->create([
            'uuid' => Str::uuid(),
            'name' => $this->currentRequest->input('name')
        ])->uuid;

        return [
            'uuid' => $task
        ];
    }

    /**
     * 상품 카테고리 상세.
     * @param string $productCategoryUUID
     * @return array
     */
    public function detailProductCategory(string $productCategoryUUID) : array
    {
        $task = $this->productCategoryMastersRepository->defaultCustomFind('uuid', $productCategoryUUID);

        return [
            'uuid' => $task->uuid,
            'name' => $task->name
        ];
    }

    /**
     * 상품 카테고리 업데이트
     * @param string $productCategoryUUID
     * @throws ClientErrorException
     */
    public function updateProductCategotry(string $productCategoryUUID) : void
    {
        if(empty($productCategoryUUID)) {
            throw new ClientErrorException(__('product.admin.update.uuid.required'));
        }

        $findTask = $this->productCategoryMastersRepository->defaultCustomFind('uuid', $productCategoryUUID);

        if(!$findTask){
            throw new ClientErrorException(__('product.admin.update.uuid.exits'));
        }

        $validator = Validator::make($this->currentRequest->all(), [
            'name' => 'required',
        ],
            [
                'name.required' => __('product.admin.update.name.required'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $this->productCategoryMastersRepository->update($findTask->id, [
            'name' => $this->currentRequest->input('name')
        ]);
    }

    /**
     * 상품 카테고리 삭제.
     * @param string $productCategoryUUID
     * @throws ClientErrorException
     */
    public function deleteProductCategory(string $productCategoryUUID) : void
    {
        //TODO : 카테고리에 상품이 있을때?
        if(empty($productCategoryUUID)) {
            throw new ClientErrorException(__('product.admin.update.uuid.required'));
        }

        $findTask = $this->productCategoryMastersRepository->defaultCustomFind('uuid', $productCategoryUUID);

        if(!$findTask){
            throw new ClientErrorException(__('product.admin.update.uuid.exits'));
        }

        $this->productCategoryMastersRepository->deleteById($findTask->id);
    }

    /**
     * 상품 카테고리 삭제(복수)
     * @throws ClientErrorException
     */
    public function deleteProductCategories() : void
    {
        $taskUUID = $this->currentRequest->input('uuid');

        if(empty($taskUUID)) {
            throw new ClientErrorException(__('product.admin.category.delete.uuid.required'));
        }

        foreach ($taskUUID as $uuid) {
            $this->productCategoryMastersRepository->defaultCustomFind('uuid', $uuid);
        }

        foreach ($taskUUID as $uuid) {
            $this->productCategoryMastersRepository->deleteByCustomColumn('uuid', $uuid);
        }
    }

    /**
     * 상품 카테고리 리스트.
     * @return array
     * @throws ServiceErrorException
     */
    public function showProductCategotry() : array
    {
        $task = $this->productCategoryMastersRepository->getWithProductCount()->toArray();

        if(empty($task)) {
            throw new ServiceErrorException(__('response.success_not_found'));
        }

        return array_map(function($item) {
            return [
                'id' => $item['id'],
                'uuid' => $item['uuid'],
                'name' => $item['name'],
                'products_count' => $item['products_count'],
            ];
        }, $task);
    }

    /**
     * 상품 등록, 수정 벨리데이션
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    public function productValidator()
    {
        return Validator::make($this->currentRequest->all(), [
            'name' => 'required|string|min:1',
            'category' => 'required|exists:product_category_masters,id',
//            'barcode' => 'nullable|string',
            'original_price' => 'required|numeric',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'sale' => 'required|in:Y,N|max:1',
            'active' => 'required|in:Y,N|max:1',
            'color' => 'required',
            'color.*' => 'integer|exists:product_color_option_masters,id',
//            'wireless' => 'nullable|exists:product_wireless_option_masters,id',
            'rep_image' => 'required',
            'rep_image.*' => 'integer|exists:media_file_masters,id',
            'detail_image' => 'required',
            'detail_image.*' => 'integer|exists:media_file_masters,id',
        ],
            [
                'name.required'=> __('product.admin.product.service.name.required'),
                'category.required'=> __('product.admin.product.service.category.required'),
                'category.exists'=> __('product.admin.product.service.category.exists'),
//                'barcode.required'=> __('product.admin.product.service.tags_required'),
                'original_price.required'=> __('product.admin.product.service.original_price.required'),
                'price.required'=> __('product.admin.product.service.price.required'),
                'price.numeric'=> __('product.admin.product.service.price.numeric'),
                'quantity.required'=> __('product.admin.product.service.quantity.required'),
                'quantity.numeric'=> __('product.admin.product.service.quantity.numeric'),
                'sale.required'=> __('product.admin.product.service.sale.required'),
                'sale.in'=> __('product.admin.product.service.sale.in'),
                'active.required'=> __('product.admin.product.service.active.required'),
                'active.in'=> __('product.admin.product.service.active.in'),
                'color.required'=> __('product.admin.product.service.color.required'),
                'color.*.integer'=> __('product.admin.product.service.color.integer'),
                'color.*.exists'=> __('product.admin.product.service.color.exists'),
//                'wireless.exists'=> __('product.admin.product.service.wireless.exists'),
                'rep_image.required'=> __('product.admin.product.service.rep_image.required'),
                'rep_image.*.integer'=> __('product.admin.product.service.rep_image.integer'),
                'rep_image.*.exists'=> __('product.admin.product.service.rep_image.exists'),
                'detail_image.required'=> __('product.admin.product.service.detail_image.required'),
                'detail_image.*.integer'=> __('product.admin.product.service.detail_image.integer'),
                'detail_image.*.exists'=> __('product.admin.product.service.detail_image.exists')
            ]);
    }

    /**
     * 상품 등록.
     * @return array
     * @throws ClientErrorException
     */
    public function createProduct() : array
    {
        $validator = $this->productValidator();

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $createTask = $this->productMastersRepository->create([
            'uuid' => Str::uuid(),
            'category' => $this->currentRequest->input('category'),
            'name' => $this->currentRequest->input('name'),
            'barcode' => $this->currentRequest->input('barcode'),
            'original_price' => $this->currentRequest->input('original_price'),
            'price' => $this->currentRequest->input('price'),
            'quantity' => $this->currentRequest->input('quantity'),
            'memo' => $this->currentRequest->input('memo'),
            'sale' => $this->currentRequest->input('sale'),
            'active' => $this->currentRequest->input('active')
        ]);

        foreach ($this->currentRequest->input('color') as $color_id) :
            $this->productOptionsRepository->create([
                'product_id' => $createTask->id,
                'color' => $color_id,
            ]);
        endforeach;

        if($this->currentRequest->input('wireless')) {
            $this->productOptionsRepository->create([
                'product_id' => $createTask->id,
                'wireless' => $this->currentRequest->input('wireless'),
            ]);
        }

        foreach ($this->currentRequest->input('rep_image') as $media_id) :
            $this->productImagesRepository->create([
                'product_id' => $createTask->id,
                'media_category' => config('extract.mediaCategory.repImage.code'),
                'media_id' => $media_id,
            ]);
        endforeach;

        foreach ($this->currentRequest->input('detail_image') as $media_id) :
            $this->productImagesRepository->create([
                'product_id' => $createTask->id,
                'media_category' => config('extract.mediaCategory.detailImage.code'),
                'media_id' => $media_id,
            ]);
        endforeach;

        return [
            'uuid' => $createTask->uuid
        ];
    }

    /**
     * 상품 정보 업데이트.
     * @param string $productUUID
     * @throws ClientErrorException
     */
    public function updateProduct(string $productUUID) : void
    {
        $product = $this->productMastersRepository->defaultCustomFind('uuid', $productUUID);

        $validator = $this->productValidator();

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $this->productMastersRepository->update($product->id, [
            'category' => $this->currentRequest->input('category'),
            'name' => $this->currentRequest->input('name'),
            'barcode' => $this->currentRequest->input('barcode'),
            'original_price' => $this->currentRequest->input('original_price'),
            'price' => $this->currentRequest->input('price'),
            'quantity' => $this->currentRequest->input('quantity'),
            'memo' => $this->currentRequest->input('memo'),
            'sale' => $this->currentRequest->input('sale'),
            'active' => $this->currentRequest->input('active')
        ]);

        // 기존 데이터 삭제.
        $this->productOptionsRepository->deleteByCustomColumn('product_id', $product->id);
        foreach ($this->currentRequest->input('color') as $color_id) :
            $this->productOptionsRepository->create([
                'product_id' => $product->id,
                'color' => $color_id,
            ]);
        endforeach;

        if($this->currentRequest->input('wireless')) {
            $this->productOptionsRepository->create([
                'product_id' => $product->id,
                'wireless' => $this->currentRequest->input('wireless'),
            ]);
        }

        $this->productImagesRepository->deleteByCustomColumn('product_id', $product->id);
        foreach ($this->currentRequest->input('rep_image') as $media_id) :
            $this->productImagesRepository->create([
                'product_id' => $product->id,
                'media_category' => config('extract.mediaCategory.repImage.code'),
                'media_id' => $media_id,
            ]);
        endforeach;

        foreach ($this->currentRequest->input('detail_image') as $media_id) :
            $this->productImagesRepository->create([
                'product_id' => $product->id,
                'media_category' => config('extract.mediaCategory.detailImage.code'),
                'media_id' => $media_id,
            ]);
        endforeach;
    }

    /**
     * 상품 삭제.
     * @param string $productUUID
     */
    public function deleteProduct(string $productUUID) : void
    {
        // TODO: 상품 단건 삭제 처리.
        $product = $this->productMastersRepository->defaultCustomFind('uuid', $productUUID);
        $this->productMastersRepository->deleteById($product->id);
        $this->productOptionsRepository->deleteByCustomColumn('product_id', $product->id);
        $this->productImagesRepository->deleteByCustomColumn('product_id', $product->id);
    }

    /**
     * 상품 삭제 복수.
     * @throws ClientErrorException
     */
    public function deleteProducts() : void
    {
        $validator = Validator::make($this->currentRequest->all(), [
            'uuid' => 'required|array|min:1',
            'uuid.*' => 'exists:product_masters,uuid'
        ],
            [
                'uuid.required' => __('product.admin.product.service.uuid.required'),
                'uuid.array' => __('product.admin.product.service.uuid.array'),
                'uuid.*.exists' => __('product.admin.product.service.uuid.exists'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        foreach ($this->currentRequest->input('uuid') as $uuid) {
            $product = $this->productMastersRepository->defaultCustomFind('uuid', $uuid);
            $this->productMastersRepository->deleteById($product->id);
            $this->productOptionsRepository->deleteByCustomColumn('product_id', $product->id);
            $this->productImagesRepository->deleteByCustomColumn('product_id', $product->id);
        }
    }

    /**
     * 상품 리스트 기본.
     * @return array
     * @throws ServiceErrorException
     */
    public function defaultShowProduct() : array
    {
        $taskResult = $this->productMastersRepository->getAdminProductMasters()->toArray();

        if(empty($taskResult)) {
            throw new ServiceErrorException(__('response.success_not_found'));
        }

        return array_map(function($item) {
            return [
                'id' => $item['id'],
                'uuid' => $item['uuid'],
                'name' => $item['name'],
                'quantity' => [
                    'number' => $item['quantity'],
                    'string' => number_format($item['quantity']),
                ],
                'original_price' => [
                    'number' => $item['original_price'],
                    'string' => number_format($item['original_price']),
                ],
                'price' => [
                    'number' => $item['price'],
                    'string' => number_format($item['price']),
                ],
                'category' => $item['category'],
                'color' => array_map(function($item) {
                    return [
                        'id' => $item['color']['id'],
                        'name' => $item['color']['name']
                    ];
                }, $item['colors']),
                'wireless' => array_map(function($item) {
                    return [
                        'id' => $item['wireless']['id'],
                        'wireless' => $item['wireless']['wireless']
                    ];
                } , $item['wireless']),
                'best_item' => !empty($item['best_item']),
                'new_item' => !empty($item['new_item'])
             ];
        }, $taskResult);
    }

    /**
     * 상품 상세
     * @param string $productUUID
     * @return array
     */
    public function detailProduct(string $productUUID) : array
    {
        $task = $this->productMastersRepository->getAdminDetailProductMasters($productUUID)->toArray();
        return [
            'uuid' => $task['uuid'],
            'category' => [
                'id' => $task['category']['id'],

                'name' => $task['category']['name']
            ],
            'name' => $task['name'],
            "barcode" => $task['barcode'],
            "original_price" => [
                'number' => $task['original_price'],
                'string' => number_format($task['original_price'])
            ],
            "price" => [
                'number' => $task['price'],
                'string' => number_format($task['price'])
            ],
            "quantity" => [
                'number' => $task['quantity'],
                'string' => number_format($task['quantity'])
            ],
            "memo" => $task['memo'],
            "sale" => $task['sale'],
            "active" => $task['active'],
            'color' => array_map(function($item) {
                return [
                    'id' => $item['color']['id'],
                    'name' => $item['color']['name'],
                ];
            }, $task['colors']),
            'wireless' => array_map(function($item) {
                return [
                    'id' => $item['wireless']['id'],
                    'wireless' => $item['wireless']['wireless']
                ];
            } , $task['wireless']),
            'rep_images' => array_map(function($item) {
                return [
                    'id' => $item['image']['id'],
                    'file_name' => $item['image']['file_name'],
                    'url' => env('APP_MEDIA_URL') . $item['image']['dest_path'] . '/' . $item['image']['file_name']
                ];
            } , $task['rep_images']),
            'detail_images' => array_map(function($item) {
                return [
                    'id' => $item['image']['id'],
                    'file_name' => $item['image']['file_name'],
                    'url' => env('APP_MEDIA_URL') . $item['image']['dest_path'] . '/' . $item['image']['file_name']
                ];
            } , $task['detail_images']),

        ];
    }

    /**
     * 상품 리뷰 리스트.
     * @return array
     * @throws ServiceErrorException
     */
    public function showProductReviews() : array {

        $reviewTask = $this->productReviewsRepository->getReviewForAdmin();

        if($reviewTask->isEmpty()) {
            throw new ServiceErrorException(__('response.success_not_found'));
        }

        $result = $reviewTask->toArray();

        $result = array_values(array_filter($result, function ($item) {
            return $item['product'];
        }));

        return array_map(function($item) {
            return [
                'id' => $item['id'],
                'user' => [
                    'id' => $item['user']['id'],
                    'name' => $item['user']['name'],
                    'email' => $item['user']['email'],
                ],
                'product' => [
                    'id' => $item['product']['id'],
                    'uuid' => $item['product']['uuid'],
                    'name' => $item['product']['name'],
                ],
                'title' => $item['title'],
                'created_at' => Carbon::parse($item['created_at'])->format('Y-m-d H:i')
            ];
        } , $result);
    }

    /**
     * 상품 리뷰 상세
     * @param Int $id
     * @return array
     * @throws ServiceErrorException
     */
    public function detailProductReviews(Int $id) : array {

        $reviewTask = $this->productReviewsRepository->getReviewDetailForAdmin($id);

        if($reviewTask->isEmpty()) {
            throw new ServiceErrorException(__('response.success_not_found'));
        }

        $result = $reviewTask->first()->toArray();

        return [
            'id' => $result['id'],
            'user' => [
                'id' => $result['user']['id'],
                'name' => $result['user']['name'],
                'email' => $result['user']['email'],
            ],
            'product' => [
                'id' => $result['product']['id'],
                'uuid' => $result['product']['uuid'],
                'name' => $result['product']['name'],
            ],
            'title' => $result['title'],
            'contents' => $result['contents'],
            'created_at' => Carbon::parse($result['created_at'])->format('Y-m-d H:i'),
            'answer' => [
                'title' => $result['answer'] ? $result['answer']['title'] : '',
                'contents' => $result['answer'] ? $result['answer']['contents'] : '',
                'created_at' => $result['answer'] ? Carbon::parse($result['answer']['created_at'])->format('Y-m-d H:i') : '',
            ]
        ];
    }

    /**
     * 상품 리뷰 답변.
     * @param Int $id
     * @throws ClientErrorException
     * @throws ServiceErrorException
     */
    public function answerProductReview(Int $id) : void {
        $reviewTask = $this->productReviewsRepository->getReviewDetailForAdmin($id);

        if($reviewTask->isEmpty()) {
            throw new ServiceErrorException(__('response.success_not_found'));
        }

        $validator = Validator::make($this->currentRequest->all(), [
            'title' => 'required',
            'contents' => 'required',
        ],
            [
                'title.required' => '제목을 입력해 주세요.',
                'contents.required' => '내용을 입력해 주세요',
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $result = $reviewTask->first()->toArray();

        $check = $this->productReviewsRepository->exitsAnswer($result['product_id'], $id);

        if($check) {
            $this->productReviewsRepository
                ->updateAnswer($result['product_id'], $id, Auth()->id(), $this->currentRequest->input('title'), $this->currentRequest->input('contents'));
        } else {
            $this->productReviewsRepository->create([
                'product_id' => $result['product_id'],
                'user_id' => Auth()->id(),
                'review_id' => $id,
                'title' => $this->currentRequest->input('title'),
                'contents' => $this->currentRequest->input('contents'),
            ]);
        }
    }

    /**
     * 상품 배지 생성.
     * @return void
     * @throws ClientErrorException
     */
    public function createProductBadgeImage() {

        $validator = Validator::make($this->currentRequest->all(), [
            'name' => 'required',
            'media_id' => 'required|exists:media_file_masters,id|unique:product_badge_masters,media_id',
        ],
            [
                'name.required' => '배지 이름을 입력해 주세요.',
                'media_id.required' => '배지 이미지를 등록해 주세요',
                'media_id.exists' => '존재 하지 않은 배지 이미지 입니다.',
                'media_id.unique' => '이미 등록되어 있는 배지 이미지 입니다.',
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $this->productBadgeMastersRepository->create([
            'name' => $this->currentRequest->input('name'),
            'media_id' => $this->currentRequest->input('media_id'),
        ]);
    }

    /**
     * 상품 배지 리스트.
     * @return array
     */
    public function listProductBadges() : array {
        $task = $this->productBadgeMastersRepository->getList();

        return array_map(function($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'image' => [
                    'id' => $item['image']['id'],
                    'file_name' => $item['image']['file_name'],
                    'url' => env('APP_MEDIA_URL') . $item['image']['dest_path'] . '/' . $item['image']['file_name']
                ],
            ];
        }, $task->toArray()) ;
    }

    /**
     * 상품 배지 상세.
     * @param Int $id
     * @return array
     * @throws ClientErrorException
     */
    public function detailProductBadges(Int $id) : array {
        $task = $this->productBadgeMastersRepository->getDetail($id);

        if($task->isEmpty()) {
            throw new ClientErrorException('데이터가 존재 하지 않습니다.');
        }

        $task = $task->first()->toArray();

        return [
            'id' => $task['id'],
            'name' => $task['name'],
            'image' => [
                'id' => $task['image']['id'],
                'file_name' => $task['image']['file_name'],
                'url' => env('APP_MEDIA_URL') . $task['image']['dest_path'] . '/' . $task['image']['file_name']
            ],
        ];
    }

    /**
     * 상품 배지 수정.
     * @param Int $id
     * @throws ClientErrorException
     */
    public function updateProductBadges(Int $id) : void {
        $validator = Validator::make($this->currentRequest->all(), [
            'name' => 'required',
//            'media_id' => 'required|exists:media_file_masters,id|unique:product_badge_masters,media_id',
            'media_id' => 'required|exists:media_file_masters,id',
        ],
            [
                'name.required' => '배지 이름을 입력해 주세요.',
                'media_id.required' => '배지 이미지를 등록해 주세요',
                'media_id.exists' => '존재 하지 않은 배지 이미지 입니다.',
                'media_id.unique' => '이미 등록되어 있는 배지 이미지 입니다.',
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $this->productBadgeMastersRepository->update($id, [
            'name' => $this->currentRequest->input('name'),
            'media_id' => $this->currentRequest->input('media_id'),
        ]);
    }
}
