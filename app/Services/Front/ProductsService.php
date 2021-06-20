<?php


namespace App\Services\Front;

use App\Repositories\ProductsRepository;
use Illuminate\Support\Carbon;

/**
 * Class ProductsService
 * @package App\Services\Front
 */
class ProductsService
{
    /**
     * @var ProductsRepository
     */
    protected ProductsRepository $productsRepository;

    /**
     * ProductsService constructor.
     * @param ProductsRepository $productsRepository
     */
    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * 상품 리스트 배열 처리.
     * @param $item
     * @return array
     */
    private static function gneratorProductsList($item) : array
    {
        return array_map(function($e) {
            $rep_images = function ($e) {
                $imageElement = $e[0]['mediafile'];
                $returnImageUrl = env('APP_MEDIA_URL') . $imageElement['dest_path'] . '/' . $e[0]['mediafile']['file_name'];
                $returnThumImageUrl = env('APP_MEDIA_URL') . $imageElement['dest_path'] . '/' . 'thum_'.$e[0]['mediafile']['file_name'];

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
                        'code_id' => $e['options']['step1'] ? $e['options']['step1']['code_id'] : '',
                        'code_name' => $e['options']['step1'] ? $e['options']['step1']['code_name'] : '',
                    ],
                    'step2' => [
                        'code_id' => $e['options']['step2'] ? $e['options']['step2']['code_id'] : '',
                        'code_name' => $e['options']['step2'] ? $e['options']['step2']['code_name'] : '',
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

    /**
     * 상품 상세 정보 배열 처리.
     * @param Object $productRelation
     * @return array
     */
    private static function gneratorProductDetail(Object $productRelation) : array
    {
        $taskRelations = $productRelation->getRelations();

        return [
            'uuid' => $productRelation->uuid,
            'category' => [
                'code_id' => $taskRelations['category']->code_id,
                'code_name' => $taskRelations['category']->code_name,
            ],
            'name' => $productRelation->name,
            'barcode' => $productRelation->barcode,
            'price' => $productRelation->price,
            'stock' => $productRelation->stock,
            'memo' => $productRelation->memo,
            'sale' => $productRelation->sale,
            'active' => $productRelation->active,
            'options' => [
                'step1' => [
                    'code_id' => $taskRelations['options']->getRelations()['step1']->code_id,
                    'code_name' => $taskRelations['options']->getRelations()['step1']->code_name,
                ],
                'step2' => [
                    'code_id' => $taskRelations['options'] ?: $taskRelations['options']->getRelations()['step2']->code_id,
                    'code_name' => $taskRelations['options'] ?:$taskRelations['options']->getRelations()['step2']->code_name,
                ],
            ],

            'images' => [
                // 상품 이미지 처리.
                'repImage' => [
                    'name' => config('extract.mediaCategory.repImage.name'),
                    'list' => array_map(function($element) {
                        return [
                            'media_id' => $element['mediafile']['id'],
                            'original_name' => $element['mediafile']['original_name'],
                            'url' => env('APP_MEDIA_URL') . $element['mediafile']['dest_path'] . '/' . $element['mediafile']['file_name'],
                            'thumb_url' => env('APP_MEDIA_URL') . $element['mediafile']['dest_path'] . '/' . 'thum_'.$element['mediafile']['file_name'],
                            'size' => $element['mediafile']['file_size']
                        ];
                    }, array_values(array_filter($taskRelations['images']->toArray(), function($element) {
                        return $element['category']['code_id'] === config('extract.mediaCategory.repImage.code');
                    })))
                ],
                // 상품 상세 이미지 처리.
                'detailImage' => [
                    'name' => config('extract.mediaCategory.detailImage.name'),
                    'list' => array_map(function($element) {
                        return [
                            'media_id' => $element['mediafile']['id'],
                            'original_name' => $element['mediafile']['original_name'],
                            'url' => env('APP_MEDIA_URL') . $element['mediafile']['dest_path'] . '/' . $element['mediafile']['file_name'],
                            'size' => $element['mediafile']['file_size'],
                        ];
                    }, array_values(array_filter($taskRelations['images']->toArray(), function($element) {
                        return $element['category']['code_id'] === config('extract.mediaCategory.detailImage.code');
                    })))
                ],
            ]
        ];
    }

    /**
     * 상품 리스트.
     * @return array
     */
    public function makeProductsList() : array
    {
        return $this->gneratorProductsList($this->productsRepository->totalProductsForList()->get()->toArray());
    }

    /**
     * 상품 상세 정보.
     * @param String $product_uuid
     * @return array
     */
    public function detailProduct(String $product_uuid) : array
    {
        return $this->gneratorProductDetail($this->productsRepository->detailProduct($product_uuid));
    }
}
