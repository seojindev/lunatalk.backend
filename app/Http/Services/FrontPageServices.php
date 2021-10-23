<?php

namespace App\Http\Services;

use App\Exceptions\ServerErrorException;
use App\Http\Repositories\Eloquent\MainSlideMastersRepository;
use App\Http\Repositories\Eloquent\ProductCategoryMastersRepository;
use App\Http\Repositories\Eloquent\MainItemsRepository;
class FrontPageServices
{
    /**
     * @var MainSlideMastersRepository
     */
    protected MainSlideMastersRepository $mainSlideMastersRepository;

    /**
     * @var ProductCategoryMastersRepository
     */
    protected ProductCategoryMastersRepository $productCategoryMastersRepository;

    protected MainItemsRepository $mainItemsRepository;

    /**
     * @param MainSlideMastersRepository $mainSlideMastersRepository
     * @param ProductCategoryMastersRepository $productCategoryMastersRepository
     */
    function __construct(MainSlideMastersRepository $mainSlideMastersRepository, ProductCategoryMastersRepository $productCategoryMastersRepository, MainItemsRepository $mainItemsRepository) {
        $this->mainSlideMastersRepository = $mainSlideMastersRepository;
        $this->productCategoryMastersRepository = $productCategoryMastersRepository;
        $this->mainItemsRepository = $mainItemsRepository;
    }

    /**
     * 홈 메인 슬라이드.
     * @return array
     * @throws ServerErrorException
     */
    public function mainSlide() : array {
        $task = $this->mainSlideMastersRepository->createMainSldesList();

        if(!$task) {
            throw new ServerErrorException();
        }

        return array_map(function($item) {
            $slide_image = $item['image'];
            return [
                'name' => $item['name'],
                'url' => [
                    'product_uuid' => isset($item['product']) ? $item['product']['uuid'] : '',
                    'slide_url' => $item['slide_url']
                ],
                'image' => [
                    'file_name' => $slide_image['file_name'],
                    'url' => env('APP_MEDIA_URL') . '/' . $slide_image['dest_path'] . '/' . $slide_image['file_name'],
                    'width' => $slide_image['width'],
                    'height' => $slide_image['height'],
                ]
            ];
        } , $task->toArray());
    }

    /**
     * @return array
     */
    public function mainProductCategory() : array {
        return array_map(function($item) {

            if(!empty($item['random_products'])) {
                $rep_image = $item['random_products']['rep_image']['image'];

                return [
                    'name' => $item['name'],
                    'uuid' => $item['random_products']['uuid'],
                    'image' => [
                        'file_name' => $rep_image['file_name'],
                        'url' => env('APP_MEDIA_URL') . '/' . $rep_image['dest_path'] . '/' . $rep_image['file_name'],
                        'width' => $rep_image['width'],
                        'height' => $rep_image['height'],
                    ]
                ];
            } else {
                return [
                    'name' => $item['name'],
                    'uuid' => null,
                    'image' => [
                        'file_name' => null,
                        'url' => null,
                        'width' => null,
                        'height' => null,
                    ]
                ];
            }
        } , $this->productCategoryMastersRepository->getRandomCategoryProduct()->toArray());
    }

    /**
     * @return array
     */
    public function mainBestProductItem() : array {
        return array_map(function($item) {
            $productItem = $item['product'];

            $randDiscount = $productItem['price'] + rand(1000, 20000);

            $randReviewCount = rand(50, 200);

            return [
                'uuid' => $item['uuid'],
                'product' => [
                    'uuid' => $productItem['uuid'],
                    'name' => $productItem['name'],
                    'discount_price' => $randDiscount,
                    'price' => $productItem['price'],
                    'color' => $productItem['color']['color']['name'],
                    'review_count' => [
                        'number' => $randReviewCount,
                        'string' => number_format($randReviewCount)
                    ],
                    'rep_image' => [
                        'file_name' => $productItem['rep_image']['image'] ? $productItem['rep_image']['image']['file_name'] : null,
                        'url' => $productItem['rep_image']['image'] ? env('APP_MEDIA_URL') . $productItem['rep_image']['image']['dest_path'] . '/' . $productItem['rep_image']['image']['file_name'] : null,
                    ],
                ],



            ];
        }, $this->mainItemsRepository->getFrontMainBestItems()->toArray());
    }

    /**
     * @return array
     */
    public function mainNewProductItem() : array {
        return array_map(function($item) {
            $productItem = $item['product'];

            $randDiscount = $productItem['price'] + rand(1000, 20000);

            $randReviewCount = rand(50, 200);

            return [
                'uuid' => $item['uuid'],
                'product' => [
                    'uuid' => $productItem['uuid'],
                    'name' => $productItem['name'],
                    'discount_price' => $randDiscount,
                    'price' => $productItem['price'],
                    'color' => $productItem['color']['color']['name'],
                    'review_count' => [
                        'number' => $randReviewCount,
                        'string' => number_format($randReviewCount)
                    ],
                    'rep_image' => [
                        'file_name' => $productItem['rep_image']['image'] ? $productItem['rep_image']['image']['file_name'] : null,
                        'url' => $productItem['rep_image']['image'] ? env('APP_MEDIA_URL') . $productItem['rep_image']['image']['dest_path'] . '/' . $productItem['rep_image']['image']['file_name'] : null,
                    ],
                ],



            ];
        }, $this->mainItemsRepository->getFrontMainNewItems()->toArray());
    }
}
