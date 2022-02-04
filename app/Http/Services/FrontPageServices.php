<?php

namespace App\Http\Services;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServerErrorException;
use App\Http\Repositories\Eloquent\MainSlideMastersRepository;
use App\Http\Repositories\Eloquent\NoticeMastersRepository;
use App\Http\Repositories\Eloquent\OrderMastersRepository;
use App\Http\Repositories\Eloquent\ProductCategoryMastersRepository;
use App\Http\Repositories\Eloquent\MainItemsRepository;
use App\Http\Repositories\Eloquent\ProductMastersRepository;
use App\Http\Repositories\Eloquent\CartsRepository;
use App\Http\Repositories\Eloquent\UserRepository;
use Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class FrontPageServices
{
    protected Request $currentRequest;
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
     * @var CartsRepository
     */
    protected CartsRepository $cartsRepository;

    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    protected OrderMastersRepository $orderMastersRepository;

    /**
     * @param Request $request
     * @param CartsRepository $cartsRepository
     * @param ProductMastersRepository $productMastersRepository
     * @param MainSlideMastersRepository $mainSlideMastersRepository
     * @param ProductCategoryMastersRepository $productCategoryMastersRepository
     * @param MainItemsRepository $mainItemsRepository
     * @param NoticeMastersRepository $noticeMastersRepository
     * @param UserRepository $userRepository
     * @param OrderMastersRepository $orderMastersRepository
     */
    function __construct(
        Request $request,
        CartsRepository $cartsRepository,
        ProductMastersRepository $productMastersRepository,
        MainSlideMastersRepository $mainSlideMastersRepository,
        ProductCategoryMastersRepository $productCategoryMastersRepository,
        MainItemsRepository $mainItemsRepository,
        NoticeMastersRepository $noticeMastersRepository,
        UserRepository $userRepository,
        OrderMastersRepository $orderMastersRepository
    ) {
        $this->currentRequest = $request;
        $this->mainSlideMastersRepository = $mainSlideMastersRepository;
        $this->productCategoryMastersRepository = $productCategoryMastersRepository;
        $this->mainItemsRepository = $mainItemsRepository;
        $this->noticeMastersRepository = $noticeMastersRepository;
        $this->productMastersRepository = $productMastersRepository;
        $this->cartsRepository = $cartsRepository;
        $this->userRepository = $userRepository;
        $this->orderMastersRepository = $orderMastersRepository;
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
     * 메인 상품 카테고리.
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
                    'color' =>  array_map(function($item) {
                        return [
                            'id' => $item['color']['id'],
                            'name' => $item['color']['name']
                        ];
                    }, $productItem['colors']),
                    'review_count' => [
                        'number' => count($productItem['reviews']),
                        'string' => number_format(count($productItem['reviews']))
                    ],
                    'rep_image' => [
                        'file_name' => $productItem['rep_image']['image'] ? $productItem['rep_image']['image']['file_name'] : null,
                        'url' => $productItem['rep_image']['image'] ? env('APP_MEDIA_URL') . $productItem['rep_image']['image']['dest_path'] . '/' . $productItem['rep_image']['image']['file_name'] : null,
                    ],
                    'badge' => array_map(function($item) {
                        return [
                            'id' => $item['badge']['id'],
                            'name' => $item['badge']['name'],
                            'image' => [
                                'id' => $item['badge']['image']['id'],
                                'file_name' => $item['badge']['image']['file_name'],
                                'url' => env('APP_MEDIA_URL') . $item['badge']['image']['dest_path'] . '/' . $item['badge']['image']['file_name']
                            ],
                        ];
                    }, $productItem['badge']),
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
                    'color' =>  array_map(function($item) {
                        return [
                            'id' => $item['color']['id'],
                            'name' => $item['color']['name']
                        ];
                    }, $productItem['colors']),
                    'review_count' => [
                        'number' => count($productItem['reviews']),
                        'string' => number_format(count($productItem['reviews']))
                    ],
                    'rep_image' => [
                        'file_name' => $productItem['rep_image']['image'] ? $productItem['rep_image']['image']['file_name'] : null,
                        'url' => $productItem['rep_image']['image'] ? env('APP_MEDIA_URL') . $productItem['rep_image']['image']['dest_path'] . '/' . $productItem['rep_image']['image']['file_name'] : null,
                    ],
                    'badge' => array_map(function($item) {
                        return [
                            'id' => $item['badge']['id'],
                            'name' => $item['badge']['name'],
                            'image' => [
                                'id' => $item['badge']['image']['id'],
                                'file_name' => $item['badge']['image']['file_name'],
                                'url' => env('APP_MEDIA_URL') . $item['badge']['image']['dest_path'] . '/' . $item['badge']['image']['file_name']
                            ],
                        ];
                    }, $productItem['badge']),
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
     * 공지 사항 상세.
     * @param String $uuid
     * @return array
     */
    public function detailNotice(String $uuid) : array {

        $task = $this->noticeMastersRepository->getNoticeDetail($uuid)->first()->toArray();

        return [
            'id' => $task['id'],
            'uuid' => $task['uuid'],
            'category' => [
                'code_id' => $task['category']['code_id'],
                'code_name' => $task['category']['code_name'],
            ],
            'title' => $task['title'],
            'content' => $task['content'],
            'images' => array_map(function($item) {
                return [
                    'file_name' => $item['image'] ? $item['image']['file_name'] : null,
                    'url' => $item['image'] ? env('APP_MEDIA_URL') . $item['image']['dest_path'] . '/' . $item['image']['file_name'] : null,
                ];
            }, $task['images']),
            'created_at' => [
                'type1' => Carbon::parse($task['created_at'])->format('Y-m-d H:i'),
                'type2' => Carbon::parse($task['created_at'])->format('Y-m-d'),
            ]

        ];
    }

    /**
     * 상품 카테고리 리스트( 상단 텝 ).
     * @param String $category_uuid
     * @return array
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
                    'color' =>  array_map(function($item) {
                        return [
                            'id' => $item['color']['id'],
                            'name' => $item['color']['name']
                        ];
                    }, $item['colors']),
                    'review_count' => [
                        'number' => count($item['reviews']),
                        'string' => number_format(count($item['reviews']))
                    ],
                    'rep_image' => [
                        'file_name' => $item['rep_image']['image'] ? $item['rep_image']['image']['file_name'] : null,
                        'url' => $item['rep_image']['image'] ? env('APP_MEDIA_URL') . $item['rep_image']['image']['dest_path'] . '/' . $item['rep_image']['image']['file_name'] : null,
                    ],
                    'badge' => array_map(function($item) {
                        return [
                            'id' => $item['badge']['id'],
                            'name' => $item['badge']['name'],
                            'image' => [
                                'id' => $item['badge']['image']['id'],
                                'file_name' => $item['badge']['image']['file_name'],
                                'url' => env('APP_MEDIA_URL') . $item['badge']['image']['dest_path'] . '/' . $item['badge']['image']['file_name']
                            ],
                        ];
                    }, $item['badge']),
                ];
            }, $categoryList['products'])
        ];
    }

    /**
     * 장바구니 리스트 상품 추가.
     * @param String $product_uuid
     * @throws ClientErrorException
     */
    public function createCartList(String $product_uuid) : void {
        $productTask = $this->productMastersRepository->defaultGetCustomFind('uuid', $product_uuid);

        if($productTask->isEmpty()) {
            throw new ModelNotFoundException();
        }

        $user_id = Auth()->id();

        $checkTask = $this->cartsRepository->getUserCart($user_id, $productTask->first()->id);

        if($checkTask->isEmpty()) {
            $this->cartsRepository->create([
                'user_id' => $user_id,
                'product_id' => $productTask->first()->id
            ]);
        } else {
            throw new ClientErrorException(__('default.error.exits_item'));
        }
    }

    /**
     * 사용자 장바구니 리스트.
     * @return array
     */
    public function cartList() : array {

        $cartTask = $this->cartsRepository->userCarts(Auth()->id());

        if($cartTask->isEmpty()) {
            throw new ModelNotFoundException();
        }

        return array_map(function($item) {
            return [
                'cart_id' => $item['id'],
                'product_uuid' => $item['product']['uuid'],
                'name' => $item['product']['name'],
                'price' => [
                    'number' => $item['product']['price'],
                    'string' => number_format($item['product']['price']),
                ],
                'color' =>  array_map(function($item) {
                    return [
                        'id' => $item['color']['id'],
                        'name' => $item['color']['name']
                    ];
                }, $item['product']['colors']),
                'rep_image' => [
                    'id' => $item['product']['rep_image']['image']['id'],
                    'file_name' => $item['product']['rep_image']['image']['file_name'],
                    'url' => env('APP_MEDIA_URL') . $item['product']['rep_image']['image']['dest_path'] . '/' . $item['product']['rep_image']['image']['file_name']
                ],
            ];
        }, $cartTask->toArray());
    }

    /**
     * 사용자 장바구니 단품 삭제.
     * @param Int $cart_id
     */
    public function deleteCart(Int $cart_id) : void {
        $user_id = Auth()->id();
        $cartTask = $this->cartsRepository->getUserCartById($user_id, $cart_id);

        if($cartTask->isEmpty()) {
            throw new ModelNotFoundException();
        }

        $this->cartsRepository->deleteByCustomColumn('id', $cart_id);
    }

    /**
     * 사용자 장바구니 복수 삭제.
     * @throws ClientErrorException
     */
    public function deletesCart() : void {

        $cartIds = $this->currentRequest->all();

        $user_id = Auth()->id();

        if(empty($cartIds)) {
            throw new ClientErrorException('삭제할 상품을 선택해 주세요.');
        }

        foreach ($cartIds as $id) :
            $this->cartsRepository->deleteCart($user_id, $id);
        endforeach;
    }

    /**
     * 내오더 정보.
     * @return array[]
     */
    public function getUserOrder() : array {

        $user_id = Auth()->id();
        $userDetail = $this->userRepository->getUserDetailById($user_id)->first()->toArray();

        // 입금전 5100020
        // 배송 준비중 5200000
        // 배송중 5200010
        // 배송완료 5200020
        // 그냥 쿼리를 4번 날리는걸로~
        return [
            'user_info' => [
                'id' => $userDetail['id'],
                'uuid' => $userDetail['uuid'],
                'name' => $userDetail['name'],
            ],
            'order_state' => [
                'price_before' => number_format($this->orderMastersRepository->getOrderBeForeCount($user_id)),
                'delivery_brfore' => number_format($this->orderMastersRepository->getOrderDeliveryBeforeCount($user_id)),
                'delivery_ing' => number_format($this->orderMastersRepository->getOrderDeliveryIngCount($user_id)),
                'delivery_end' => number_format($this->orderMastersRepository->getOrderDeliveryEndCount($user_id))
            ],
            'list' => [
                'order' => array_map(function($item) {
                    $rep_image = $item['products'][0]['product']['rep_image'];

                    return [
                        'uuid' => $item['uuid'],
                        'order_name' => $item['order_name'],
                        'order_price' => [
                            'number' => $item['order_price'],
                            'string' => number_format($item['order_price']),
                        ],
                        'created_at' => [
                            'type1' => Carbon::parse($item['created_at'])->format('Y-m-d H:i:s'),
                            'type2' => Carbon::parse($item['created_at'])->format('Y-m-d'),
                            'type3' => Carbon::parse($item['created_at'])->format('Y년 m월 d일'),
                        ],
                        'rep_image' => [
                            'id' => $rep_image['image']['id'],
                            'file_name' => $rep_image['image']['file_name'],
                            'url' => env('APP_MEDIA_URL') . $rep_image['image']['dest_path'] . '/' . $rep_image['image']['file_name']
                        ],

                        'state' => [
                            'code_id' => $item['state']['code_id'],
                            'code_name' => $item['state']['code_name'],
                        ]

                    ];
                }, $this->orderMastersRepository->getOrderProducts($user_id)->toArray()),
                'cancel' =>  array_map(function($item) {
                    $rep_image = $item['products'][0]['product']['rep_image'];

                    return [
                        'uuid' => $item['uuid'],
                        'order_name' => $item['order_name'],
                        'order_price' => [
                            'number' => $item['order_price'],
                            'string' => number_format($item['order_price']),
                        ],
                        'created_at' => [
                            'type1' => Carbon::parse($item['created_at'])->format('Y-m-d H:i:s'),
                            'type2' => Carbon::parse($item['created_at'])->format('Y-m-d'),
                            'type3' => Carbon::parse($item['created_at'])->format('Y년 m월 d일'),
                        ],
                        'rep_image' => [
                            'id' => $rep_image['image']['id'],
                            'file_name' => $rep_image['image']['file_name'],
                            'url' => env('APP_MEDIA_URL') . $rep_image['image']['dest_path'] . '/' . $rep_image['image']['file_name']
                        ],

                        'state' => [
                            'code_id' => $item['state']['code_id'],
                            'code_name' => $item['state']['code_name'],
                        ]

                    ];
                }, $this->orderMastersRepository->getOrderProducts($user_id)->toArray()),
            ]
        ];
    }

    /**
     * 내정보 페이지 오더 상세.
     * @param String $uuid
     * @return array
     */
    public function myOrderDetail(String $uuid) : array {

        $orderTask = $this->orderMastersRepository->getOrderMasterDetail($uuid);

        if($orderTask->isEmpty()) {
            throw new ModelNotFoundException();
        }

        $taskResult = $orderTask->first()->toArray();

        $products = $taskResult['products'];

        return [
            'uuid' => $taskResult['uuid'],
            'order_info' => [
                'name' => $taskResult['name'],
                'phone' => [
                    'type1' => $taskResult['phone'],
                    'type2' => Helper::phoneNumberAddHyphen($taskResult['phone'])
                ],
                'email' => $taskResult['email'],
                'message' => $taskResult['message'],
                'order_name' => $taskResult['order_name'],
                'order_price' => [
                    'number' => $taskResult['order_price'],
                    'string' => number_format($taskResult['order_price'])
                ],
                'active' => $taskResult['active'],
                'state' => [
                    'code_id' => $taskResult['state']['code_id'],
                    'code_name' => $taskResult['state']['code_name']
                ],
                'delivery' => [
                    'code_id' => $taskResult['delivery']['code_id'],
                    'code_name' => $taskResult['delivery']['code_name']
                ],
                'receive' => [
                    'code_id' => $taskResult['receive']['code_id'],
                    'code_name' => $taskResult['receive']['code_name']
                ],
                'order_log' => $taskResult['order_log'],
            ],
            'order_address' => [
                'zipcode' => $taskResult['address']['zipcode'],
                'step1' => $taskResult['address']['step1'],
                'step2' => $taskResult['address']['step2'],
            ],
            'products' => array_map(function($element) {
                $item = $element['product'];
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
                    'wireless' => $item['wireless'] ? [
                        'id' => $item['wireless']['wireless']['id'],
                        'wireless' => $item['wireless']['wireless']['wireless'],
                    ] : null,
                    'rep_images' => array_map(function($item) {
                        return [
                            'id' => $item['image']['id'],
                            'file_name' => $item['image']['file_name'],
                            'url' => env('APP_MEDIA_URL') . $item['image']['dest_path'] . '/' . $item['image']['file_name']
                        ];
                    } , $item['rep_images']),
                ];
            }, $products)
        ];
    }
}
