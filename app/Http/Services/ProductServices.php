<?php

namespace App\Http\Services;

use App\Exceptions\ServiceErrorException;
use App\Http\Repositories\Eloquent\ProductMastersRepository;

class ProductServices {

    /**
     * @var ProductMastersRepository
     */
    protected ProductMastersRepository $productMastersRepository;

    /**
     * @param ProductMastersRepository $productMastersRepository
     */
    function __construct(ProductMastersRepository $productMastersRepository) {
        $this->productMastersRepository = $productMastersRepository;
    }

    /**
     * 상품 전체 상체 리스트.
     * @return array
     * @throws ServiceErrorException
     */
    public function productTotalList () : array {

        $taskResult = $this->productMastersRepository->getProductListMasters()->toArray();

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
                'new_item' => !empty($item['new_item']),
                'rep_images' => array_map(function($item) {
                    return [
                        'id' => $item['image']['id'],
                        'file_name' => $item['image']['file_name'],
                        'url' => env('APP_MEDIA_URL') . $item['image']['dest_path'] . '/' . $item['image']['file_name']
                    ];
                } , $item['rep_images']),
                'detail_images' => array_map(function($item) {
                    return [
                        'id' => $item['image']['id'],
                        'file_name' => $item['image']['file_name'],
                        'url' => env('APP_MEDIA_URL') . $item['image']['dest_path'] . '/' . $item['image']['file_name']
                    ];
                }, $item['detail_images']),
            ];
        }, $taskResult);
    }
}
