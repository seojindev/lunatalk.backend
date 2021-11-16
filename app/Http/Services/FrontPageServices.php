<?php

namespace App\Http\Services;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServerErrorException;
use App\Http\Repositories\Eloquent\MainSlideMastersRepository;
use App\Http\Repositories\Eloquent\NoticeMastersRepository;
use App\Http\Repositories\Eloquent\ProductCategoryMastersRepository;
use App\Http\Repositories\Eloquent\MainItemsRepository;
use App\Http\Repositories\Eloquent\ProductMastersRepository;
use App\Http\Repositories\Eloquent\WishsRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;

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

    /**
     * @var MainItemsRepository
     */
    protected MainItemsRepository $mainItemsRepository;

    /**
     * @var NoticeMastersRepository
     */
    protected NoticeMastersRepository $noticeMastersRepository;

    /**
     * @var ProductMastersRepository
     */
    protected ProductMastersRepository $productMastersRepository;

    /**
     * @var WishsRepository
     */
    protected WishsRepository $wishsRepository;

    /**
     * @param WishsRepository $wishsRepository
     * @param ProductMastersRepository $productMastersRepository
     * @param MainSlideMastersRepository $mainSlideMastersRepository
     * @param ProductCategoryMastersRepository $productCategoryMastersRepository
     * @param MainItemsRepository $mainItemsRepository
     * @param NoticeMastersRepository $noticeMastersRepository
     */
    function __construct(WishsRepository $wishsRepository, ProductMastersRepository $productMastersRepository, MainSlideMastersRepository $mainSlideMastersRepository, ProductCategoryMastersRepository $productCategoryMastersRepository, MainItemsRepository $mainItemsRepository, NoticeMastersRepository $noticeMastersRepository) {
        $this->mainSlideMastersRepository = $mainSlideMastersRepository;
        $this->productCategoryMastersRepository = $productCategoryMastersRepository;
        $this->mainItemsRepository = $mainItemsRepository;
        $this->noticeMastersRepository = $noticeMastersRepository;
        $this->productMastersRepository = $productMastersRepository;
        $this->wishsRepository = $wishsRepository;
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
                    'uuid' => $item['uuid'],
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
     * 메인 베스트 아이템.
     * @return array
     */
    public function mainBestProductItem() : array {
        return array_map(function($item) {
            $productItem = $item['product'];
            $randReviewCount = rand(50, 200);

            return [
                'uuid' => $item['uuid'],
                'product' => [
                    'uuid' => $productItem['uuid'],
                    'name' => $productItem['name'],
                    'original_price' => [
                        'number' => $productItem['original_price'],
                        'string' => number_format($productItem['original_price'])
                    ],
                    'price' => [
                        'number' => $productItem['price'],
                        'string' => number_format($productItem['price'])
                    ],
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
     * 메인 뉴 아이템
     * @return array
     */
    public function mainNewProductItem() : array {
        return array_map(function($item) {
            $productItem = $item['product'];
            $randReviewCount = rand(50, 200);

            return [
                'uuid' => $item['uuid'],
                'product' => [
                    'uuid' => $productItem['uuid'],
                    'name' => $productItem['name'],
                    'original_price' => [
                        'number' => $productItem['original_price'],
                        'string' => number_format($productItem['original_price'])
                    ],
                    'price' => [
                        'number' => $productItem['price'],
                        'string' => number_format($productItem['price'])
                    ],
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

    /**
     * 메인 공지 사항 5개
     * @return array
     */
    public function mainNoticeList() : array {
        return array_map(function($item) {
            return [
                'uuid' => $item['uuid'],
                'title' => $item['title'],
                'category' => [
                    'code_id' => $item['category']['code_id'],
                    'code_name' => $item['category']['code_name'],
                ],
                'created_at' => Carbon::parse($item['created_at'])->format('Y-m-d'),
            ];
        }, $this->noticeMastersRepository->getMainNoticeList()->toArray());
    }

    /**
     * 상품 카테고리 리스트( 상단 텝 ).
     */
    public function productCategoryList(String $category_uuid) : array {

        $task = $this->productCategoryMastersRepository->getProductCategoryList($category_uuid);

        if($task->isEmpty()) {
            throw new ModelNotFoundException();
        }

        $categoryList = $task->first()->toArray();

        return [
            'uuid' => $category_uuid,
            'products' => array_map(function($item) {
                $randReviewCount = rand(50, 200);
                return [
                    'uuid' => $item['uuid'],
                    'name' => $item['name'],
                    'original_price' => [
                        'number' => $item['original_price'],
                        'string' => number_format($item['original_price'])
                    ],
                    'price' => [
                        'number' => $item['price'],
                        'string' => number_format($item['price'])
                    ],
                    'color' => isset($item['color']['color']['name']) && $item['color']['color']['name'] ? $item['color']['color']['name'] : null,
                    'review_count' => [
                        'number' => $randReviewCount,
                        'string' => number_format($randReviewCount)
                    ],
                    'rep_image' => [
                        'file_name' => $item['rep_image']['image'] ? $item['rep_image']['image']['file_name'] : null,
                        'url' => $item['rep_image']['image'] ? env('APP_MEDIA_URL') . $item['rep_image']['image']['dest_path'] . '/' . $item['rep_image']['image']['file_name'] : null,
                    ],
                ];
            }, $categoryList['products'])
        ];
    }

    /**
     * 상품 상세 정보.
     * @param String $uuid
     * @return array
     * @throws ClientErrorException
     */
    public function productDetail(String $uuid) : array {
        $task = $this->productMastersRepository->getProductDetailInfo($uuid)->first();

        if(!$task) {
            throw new ClientErrorException('존재 하지 않은 상품 입니다.');
        }

        $product = $task->toArray();

        $options = $product['options'];

        $colors = array();
        $wireless = array();
        foreach ($options as $option) :
            if($option['color']) {
                $colors[] = [
                    'id' => $option['color']['id'],
                    'name' => $option['color']['name']
                ];
            }

            if($option['wireless']) {
                $wireless[] = [
                    'id' => $option['wireless']['id'],
                    'wireless' => $option['wireless']['wireless']
                ];
            }
        endforeach;


        return [
            'uuid' => $product['uuid'],
            'category' => [
                'uuid' => $product['category']['uuid'],
                'name' => $product['category']['name'],
            ],
            'name' => $product['name'],
            'barcode' => $product['barcode'],
            'original_price' => [
                'number' => $product['original_price'],
                'string' => number_format($product['original_price'])
            ],
            'price' => [
                'number' => $product['price'],
                'string' => number_format($product['price'])
            ],
            'quantity' => [
                'number' => $product['quantity'],
                'string' => number_format($product['quantity']),
            ],
            'options' => [
                'color' => $colors,
                'wireless' => $wireless,
            ],
            'image' => [
                'rep' => array_map(function($item) {
                    return [
                        'id' => $item['image']['id'],
                        'file_name' => $item['image']['file_name'],
                        'url' => env('APP_MEDIA_URL') . $item['image']['dest_path'] . '/' . $item['image']['file_name'],
                    ];
                }, $product['rep_images']),
                'detail' => array_map(function($item) {
                    return [
                        'id' => $item['image']['id'],
                        'file_name' => $item['image']['file_name'],
                        'url' => env('APP_MEDIA_URL') . $item['image']['dest_path'] . '/' . $item['image']['file_name'],
                    ];
                }, $product['detail_images'])
            ],
            'sale' => $product['sale'],
            'active' => $product['active'],
            'created_at' => [
                'type1' => Carbon::parse($product['created_at'])->format('Y-m-d H:i:s'),
                'type2' => Carbon::parse($product['created_at'])->format('Y-m-d'),
                'type3' => Carbon::parse($product['created_at'])->format('Y년 m월 d일'),
            ],
        ];
    }

    /**
     * 위시 리스트 생성.
     * @param String $product_uuid
     * @throws ClientErrorException
     */
    public function createWishList(String $product_uuid) : void {
        $productTask = $this->productMastersRepository->defaultGetCustomFind('uuid', $product_uuid);

        if($productTask->isEmpty()) {
            throw new ModelNotFoundException();
        }

        $user_id = Auth()->id();

        $checkTask = $this->wishsRepository->getUserWish($user_id, $productTask->first()->id);

        if($checkTask->isEmpty()) {
            $this->wishsRepository->create([
                'user_id' => $user_id,
                'product_id' => $productTask->first()->id
            ]);
        } else {
            throw new ClientErrorException(__('default.error.exits_item'));
        }
    }
}
