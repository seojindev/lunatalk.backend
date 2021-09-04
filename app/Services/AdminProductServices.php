<?php

namespace App\Services;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use App\Repositories\Eloquent\ProductCategoryMastersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminProductServices
{
    protected Request $currentRequest;
    protected ProductCategoryMastersRepository $productCategoryMastersRepository;

    function __construct(Request $request, ProductCategoryMastersRepository $productCategoryMastersRepository)
    {
        $this->currentRequest = $request;
        $this->productCategoryMastersRepository = $productCategoryMastersRepository;
    }

    /**
     * @return array
     * @throws ClientErrorException
     */
    public function createProduct() : array
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

    public function updateProduct(string $productUUID) : void
    {
        if(empty($productUUID)) {
            throw new ClientErrorException(__('product.admin.update.uuid.required'));
        }

        $findTask = $this->productCategoryMastersRepository->defaultCustomFind('uuid', $productUUID);

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

    public function deleteProduct(string $productUUID) : void
    {
        if(empty($productUUID)) {
            throw new ClientErrorException(__('product.admin.update.uuid.required'));
        }

        $findTask = $this->productCategoryMastersRepository->defaultCustomFind('uuid', $productUUID);

        if(!$findTask){
            throw new ClientErrorException(__('product.admin.update.uuid.exits'));
        }

        $this->productCategoryMastersRepository->deleteById($findTask->id);
    }

    public function showProduct() : array
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
}
