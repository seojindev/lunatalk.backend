<?php

namespace App\Http\Services;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use App\Http\Repositories\Eloquent\ProductCategoryMastersRepository;
use App\Http\Repositories\Eloquent\ProductMastersRepository;
use App\Http\Repositories\Eloquent\ProductOptionsRepository;
use App\Http\Repositories\Eloquent\ProductImagesRepository;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @param ProductCategoryMastersRepository $productCategoryMastersRepository
     * @param ProductMastersRepository $productMastersRepository
     * @param ProductOptionsRepository $productOptionsRepository
     * @param ProductImagesRepository $productImagesRepository
     */
    function __construct(Request $request, ProductCategoryMastersRepository $productCategoryMastersRepository, ProductMastersRepository $productMastersRepository, ProductOptionsRepository $productOptionsRepository, ProductImagesRepository $productImagesRepository)
    {
        $this->currentRequest = $request;
        $this->productCategoryMastersRepository = $productCategoryMastersRepository;
        $this->productMastersRepository = $productMastersRepository;
        $this->productOptionsRepository = $productOptionsRepository;
        $this->productImagesRepository = $productImagesRepository;
    }

    /**
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
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    public function productValidator()
    {
        return Validator::make($this->currentRequest->all(), [
            'name' => 'required|string|min:1',
            'category' => 'required|exists:product_category_masters,id',
//            'barcode' => 'nullable|string',
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
                }, $item['color']),
                'wireless' => array_map(function($item) {
                    return [
                        'id' => $item['wireless']['id'],
                        'wireless' => $item['wireless']['wireless']
                    ];
                } , $item['wireless'])
            ];
        }, $taskResult);
    }

    /**
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
            }, $task['color']),
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
}
