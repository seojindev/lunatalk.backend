<?php

namespace App\Http\Services;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use App\Http\Repositories\Eloquent\ProductMastersRepository;
use App\Http\Repositories\Eloquent\ProductReviewsRepository;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductServices {

    /**
     * @var ProductMastersRepository
     */
    protected ProductMastersRepository $productMastersRepository;

    /**
     * @var ProductReviewsRepository
     */
    protected ProductReviewsRepository $productReviewsRepository;

    /**
     * @var Request
     */
    protected Request $currentRequest;

    /**
     * @param Request $currentRequest
     * @param ProductMastersRepository $productMastersRepository
     * @param ProductReviewsRepository $productReviewsRepository
     */
    function __construct(Request $currentRequest, ProductMastersRepository $productMastersRepository, ProductReviewsRepository $productReviewsRepository) {
        $this->productMastersRepository = $productMastersRepository;
        $this->currentRequest = $currentRequest;
        $this->productReviewsRepository = $productReviewsRepository;
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
//                'wireless' => array_map(function($item) {
//                    return [
//                        'id' => $item['wireless']['id'],
//                        'wireless' => $item['wireless']['wireless']
//                    ];
//                } , $item['wireless']),
                'wireless' => $item['wireless'] ? [
                    'id' => $item['wireless']['wireless']['id'],
                    'wireless' => $item['wireless']['wireless']['wireless'],
                ] : null,
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
            'reviews' => array_map(function($item) {
                $answer = [];
                if($item['answer']) {
                    $answer = [
                        'title' => $item['answer']['title'],
                        'contents' => $item['answer']['contents'],
                        'created_at' => [
                            'type1' => Carbon::parse($item['answer']['created_at'])->format('Y-m-d H:i:s'),
                            'type2' => Carbon::parse($item['answer']['created_at'])->format('Y-m-d'),
                            'type3' => Carbon::parse($item['answer']['created_at'])->format('Y년 m월 d일'),
                        ],
                    ];
                }
                return [
                    'id'=> $item['id'],
                    'title' => $item['title'],
                    'content' => $item['contents'],
                    'user_name' => $item['user']['name'],
                    'created_at' => [
                        'type1' => Carbon::parse($item['created_at'])->format('Y-m-d H:i:s'),
                        'type2' => Carbon::parse($item['created_at'])->format('Y-m-d'),
                        'type3' => Carbon::parse($item['created_at'])->format('Y년 m월 d일'),
                    ],
                    'answer' => $answer
                ];
            }, $product['reviews'])
        ];
    }

    /**
     * 상품 상세 검색.
     * @param String $search
     * @return array
     * @throws ClientErrorException
     * @throws ServiceErrorException
     */
    public function productTotalSearchList(String $search) : array {

        if(empty($search)) {
            throw new ClientErrorException('검색어를 입력해 주세요.');
        }

        $taskResult = $this->productMastersRepository->getProductListSearchMasters(urldecode($search))->toArray();

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

    /**
     * 상품 검색
     * @param String $search
     * @return array
     * @throws ClientErrorException
     * @throws ServiceErrorException
     */
    public function productTotalSearchListSub(String $search) : array {

        if(empty($search)) {
            throw new ClientErrorException('검색어를 입력해 주세요.');
        }

        $taskResult = $this->productMastersRepository->getProductListSearchSub(base64_decode($search))->toArray();

        if(empty($taskResult)) {
            throw new ServiceErrorException(__('response.success_not_found'));
        }

        return array_map(function($item) {
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
                'color' => array_map(function($item) {
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
        }, $taskResult);
    }

    /**
     * 상품 리뷰 등록.
     * @param String $product_uuid
     * @throws ClientErrorException
     */
    public function createProductReview(String $product_uuid) : void {
        $task = $this->productMastersRepository->getProductDetailInfo($product_uuid)->first();

        if(!$task) {
            throw new ClientErrorException('존재 하지 않은 상품 입니다.');
        }

        $validator = Validator::make($this->currentRequest->all(), [
            'title' => 'required',
            'review' => 'required',
        ],
            [
                'title.required' => '제목을 입력해 주세요.',
                'review.required' => '내용을 입력해 주세요',
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $reviewTitle = $this->currentRequest->input('title');
        $reviewContent = $this->currentRequest->input('review');

        $this->productReviewsRepository->create([
            'product_id' => $task->id,
            'user_id' => Auth()->id(),
            'title' => $reviewTitle,
            'contents' => $reviewContent
        ]);
    }

    /**
     * 리뷰 리스트.
     * @param String $product_uuid
     * @return array
     * @throws ClientErrorException
     */
    public function listProductReview(String $product_uuid) : array {
        $productTask = $this->productMastersRepository->getProductDetailInfo($product_uuid)->first();

        if(!$productTask) {
            throw new ClientErrorException('존재 하지 않은 상품 입니다.');
        }

        $task = $this->productReviewsRepository->getReview($productTask->id);
        if($task->isEmpty()) {
            throw new ClientErrorException('데이터가 존재 하지 않습니다.');
        }

        return array_map(function ($item) {
            $answer = [];
            if ($item['answer']) {
                $answer = [
                    'title' => $item['answer']['title'],
                    'contents' => $item['answer']['contents'],
                    'created_at' => [
                        'type1' => Carbon::parse($item['answer']['created_at'])->format('Y-m-d H:i:s'),
                        'type2' => Carbon::parse($item['answer']['created_at'])->format('Y-m-d'),
                        'type3' => Carbon::parse($item['answer']['created_at'])->format('Y년 m월 d일'),
                    ],
                ];
            }
            return [
                'id' => $item['id'],
                'title' => $item['title'],
                'content' => $item['contents'],
                'user_name' => $item['user']['name'],
                'created_at' => [
                    'type1' => Carbon::parse($item['created_at'])->format('Y-m-d H:i:s'),
                    'type2' => Carbon::parse($item['created_at'])->format('Y-m-d'),
                    'type3' => Carbon::parse($item['created_at'])->format('Y년 m월 d일'),
                ],
                'answer' => $answer
            ];
        }, $task->toArray());
    }
}
