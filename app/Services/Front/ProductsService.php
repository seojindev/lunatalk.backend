<?php


namespace App\Services\Front;

use App\Repositories\ProductsRepository;
use Illuminate\Support\Carbon;

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
                $imageElement = $e[0]['mediafile'];
                $returnImageUrl = env('APP_MEDIA_URL') . '/' . $imageElement['dest_path'] . '/' . $e[0]['mediafile']['file_name'];
                $returnThumImageUrl = env('APP_MEDIA_URL') . '/' . $imageElement['dest_path'] . '/' . 'thum_'.$e[0]['mediafile']['file_name'];

                return [
                    'origin' => $returnImageUrl,
                    'thum' => $returnThumImageUrl
                ];
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
                'options' => [
                    'step1' => [
                        'code_id' => $e['options']['step1']['code_id'],
                        'code_name' => $e['options']['step1']['code_name'],
                    ],
                    'step2' => [
                        'code_id' => $e['options']['step2']['code_id'],
                        'code_name' => $e['options']['step2']['code_name'],
                    ],
                ],
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
                'rep_image' => $rep_images($e['images']),
                'created_at' => Carbon::parse($e['created_at'])->format('Y년 m월 d일'),
            ];
        }, $item);
    }

    public function makeProductsList() : array
    {
        return $this->gneratorProductsList($this->productsRepository->totalProductsForList()->get()->toArray());
    }

    public function detailProduct(String $product_uuid) : array
    {
        $task = $this->productsRepository->detailProduct($product_uuid);
        $taskRelations = $task->getRelations();

        // TODO 이미지 배열 처리.
        print_r($taskRelations['images'][0]);

        return [
//            'all' => $task,
            'uuid' => $task->uuid,
            'category' => [
                'code_id' => $taskRelations['category']->code_id,
                'code_name' => $taskRelations['category']->code_name,
            ],
            'name' => $task->name,
            'barcode' => $task->barcode,
            'price' => $task->price,
            'stock' => $task->stock,
            'memo' => $task->memo,
            'sale' => $task->sale,
            'active' => $task->active,
            'options' => [
                'step1' => [
                    'code_id' => $taskRelations['options']->getRelations()['step1']->code_id,
                    'code_name' => $taskRelations['options']->getRelations()['step1']->code_name,
                ],
                'step2' => [
                    'code_id' => $taskRelations['options']->getRelations()['step2']->code_id,
                    'code_name' => $taskRelations['options']->getRelations()['step2']->code_name,
                ],
            ],
        ];
    }


}
