<?php


namespace App\Services\Front;

use App\Repositories\ProductsRepository;

class ProductsService
{

    protected ProductsRepository $productsRepository;


    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    private static function gneratorProductsList($item) : array
    {
        return array_map(function($e) {
            $rep_images = function ($e) {
                print_r($e);
            };

            return [
                'product_id' => $e['id'],
                'product_uuid' => $e['uuid'],
                'category' => [
                    'code_id' => $e['category']['code_id'],
                    'code_name' => $e['category']['code_name'],
                ],
                'name' => $e['name'],
                'barcode' => $e['barcode'],
                'price' => [
                    'number' => $e['price'],
                    'string' => number_format($e['price'])
                ],
                'stock' => [
                    'number' => $e['stock'],
                    'string' => number_format($e['stock'])
                ],
                'memo' => $e['memo'],
                'sale' => $e['sale'],
                'active' => $e['active'],
                'rep_image' => $rep_images($e['images'])
            ];
        }, $item);
    }

    public function makeProductsList() : array
    {
        $taskResult = $this->productsRepository->totalProductsForList()->get()->toArray();


        return $this->gneratorProductsList($taskResult);
    }


}
