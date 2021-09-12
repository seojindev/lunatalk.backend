<?php

namespace App\Services;

use App\Exceptions\ClientErrorException;
use App\Repositories\Eloquent\ProductCategoryMastersRepository;
use App\Repositories\Eloquent\ProductMastersRepository;
use App\Repositories\Eloquent\ProductOptionsRepository;
use App\Repositories\Eloquent\ProductImagesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     */
    public function showProductCategotry() : array
    {
        $task = $this->productCategoryMastersRepository->getWithProductCount()->toArray();

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
            'stock' => 'required|numeric',
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
                'stock.required'=> __('product.admin.product.service.stock.required'),
                'stock.numeric'=> __('product.admin.product.service.stock.numeric'),
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
            'category' => $this->currentRequest->input('category'),
            'name' => $this->currentRequest->input('name'),
            'barcode' => $this->currentRequest->input('barcode'),
            'price' => $this->currentRequest->input('price'),
            'stock' => $this->currentRequest->input('stock'),
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
            'stock' => $this->currentRequest->input('stock'),
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
        $this->productImagesRepository->deleteByCustomColumn('product_id', $product->id);;
    }

    /**
     * @throws ClientErrorException
     */
    public function deleteProducts() : void
    {
        $taskUUID = $this->currentRequest->input('uuid');

        if(empty($taskUUID)) {
            throw new ClientErrorException(__('product.admin.product.service.uuid.required'));
        }

        foreach ($taskUUID as $uuid) {
            $this->productMastersRepository->defaultCustomFind('uuid', $uuid);
        }

        foreach ($taskUUID as $uuid) {
            $this->productMastersRepository->deleteByCustomColumn('uuid', $uuid);
        }
    }

    /**
     * @param Int $page
     * @return array
     */
    public function defaultShowProduct(Int $page = 1) : array
    {
        $taskResult = $this->productMastersRepository->getAdminProductMasters()->toArray();

        return array_map(function($item){
            return [
                'id' => $item['id'],
                'uuid' => $item['uuid'],
                'name' => $item['name'],
                'category' => $item['category'],
                'options' => $item['options']
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
                'uuid' => $task['category']['uuid'],
                'name' => $task['category']['name']
            ],
            'name' => $task['name'],
            "barcode" => $task['barcode'],
            "price" => [
                'number' => $task['price'],
                'string' => number_format($task['price'])
            ],
            "stock" => [
                'number' => $task['stock'],
                'string' => number_format($task['stock'])
            ],
            "memo" => $task['memo'],
            "sale" => $task['sale'],
            "active" => $task['active'],
            "options" => array_map(function($item) {
                return [
                    "color" => $item['color']['name'],
                    "wireless" => $item['wireless']['wireless'],
                ];
            } , $task['options']),
        ];
    }
}
