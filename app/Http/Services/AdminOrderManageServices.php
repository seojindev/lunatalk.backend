<?php

namespace App\Http\Services;

use App\Exceptions\ClientErrorException;
use App\Http\Repositories\Eloquent\OrderMastersRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Helper;
use Illuminate\Support\Facades\Validator;

class AdminOrderManageServices
{
    /**
     * @var Request
     */
    protected Request $currentRequest;

    /**
     * @var OrderMastersRepository
     */
    protected OrderMastersRepository $orderMastersRepository;

    /**
     * @param OrderMastersRepository $orderMastersRepository
     * @param Request $currentRequest
     */
    function __construct(OrderMastersRepository $orderMastersRepository, Request $currentRequest) {
        $this->orderMastersRepository = $orderMastersRepository;
        $this->currentRequest = $currentRequest;
    }

    /**
     * 주문 리스트. ( 어드민 )
     * @return array
     */
    public function showOrder() : array {
        $orderTask = $this->orderMastersRepository->getAdminOrderMaster();
        if($orderTask->isEmpty()) {
           throw new ModelNotFoundException();
        }

        return array_map(function($item) {

            $payments = $item['payments'] ? [
                'id' => $item['payments']['id'],
                'order_id' => $item['payments']['order_id'],
                'method' => $item['payments']['method'],
                'status' => $item['payments']['status'],
            ] : null;

            return [
                'id' => $item['id'],
                'uuid' => $item['uuid'],
                'order_name' => $item['order_name'],
                'order_price' => [
                    'number' => $item['order_price'],
                    'string' => number_format($item['order_price']),
                ],
                'user' => [
                    'id' => $item['user']['id'],
                    'uuid' => $item['user']['uuid'],
                    'login_id' => $item['user']['login_id'],
                    'name' => $item['user']['name'],
                    'email' => $item['user']['email'],
                    'phone_number' => [
                        'type1' => !empty($item['user']['phone_verifies']['phone_number']) ? Crypt::decryptString($item['user']['phone_verifies']['phone_number']) : null,
                        'type2' => !empty($item['user']['phone_verifies']['phone_number']) ? Helper::phoneNumberAddHyphen(Crypt::decryptString($item['user']['phone_verifies']['phone_number'])) : null,
                    ],
                ],
                'active' => $item['active'],
                'state' => [
                    'code_id' => $item['state']['code_id'],
                    'code_name' => $item['state']['code_name'],
                ],
                'delivery' => [
                    'code_id' => $item['delivery']['code_id'],
                    'code_name' => $item['delivery']['code_name'],
                ],
                'payments' => $payments,
                'created_at' => [
                    'type1' => Carbon::parse($item['created_at'])->format('Y-m-d H:i'),
                    'type2' => Carbon::parse($item['created_at'])->format('Y-m-d'),
                ]
            ];
        } , $orderTask->toArray());
    }

    /**
     * 주문 상세 ( 어드민 )
     * @param String $uuid
     * @return array
     */
    public function showOrderDetail(String $uuid) : array {

        $task = $this->orderMastersRepository->getAdminOrderMasterDetail($uuid);

        if($task->isEmpty()) {
            throw new ModelNotFoundException();
        }

        $item = $task->first()->toArray();

        return [
            'id' => $item['id'],
            'uuid' => $item['uuid'],
            'order_name' => $item['order_name'],
            'order_price' => [
                'number' => $item['order_price'],
                'string' => number_format($item['order_price']),
            ],
            'user' => [
                'id' => $item['user']['id'],
                'uuid' => $item['user']['uuid'],
                'login_id' => $item['user']['login_id'],
                'name' => $item['user']['name'],
                'email' => $item['user']['email'],
                'phone_number' => [
                    'type1' => !empty($item['user']['phone_verifies']['phone_number']) ? Crypt::decryptString($item['user']['phone_verifies']['phone_number']) : null,
                    'type2' => !empty($item['user']['phone_verifies']['phone_number']) ? Helper::phoneNumberAddHyphen(Crypt::decryptString($item['user']['phone_verifies']['phone_number'])) : null,
                ],
            ],
            'active' => $item['active'],
            'state' => [
                'code_id' => $item['state']['code_id'],
                'code_name' => $item['state']['code_name'],
            ],
            'delivery' => [
                'code_id' => $item['delivery']['code_id'],
                'code_name' => $item['delivery']['code_name'],
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
            }, $item['products']),
            'payments' => $item['payments'],
            'created_at' => [
                'type1' => Carbon::parse($item['created_at'])->format('Y-m-d H:i'),
                'type2' => Carbon::parse($item['created_at'])->format('Y-m-d'),
            ],
        ];
    }

    /**
     * 주문 상품 상태 업데이트.
     * @param String $uuid
     * @return void
     * @throws ClientErrorException
     */
    public function changeDelivery(String $uuid): void {
        $orderTask = $this->orderMastersRepository->defaultCustomFind('uuid', $uuid);

        $validator = Validator::make($this->currentRequest->all(), [
            'change_code' => 'required|exists:codes,code_id'
        ],[
            'change_code.required' => '변경할 코드를 등록해 주세요.',
            'change_code.exists' => '정확한 코드를 등록해 주세요.',
        ]);

        if( $validator->fails()) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $this->orderMastersRepository->update($orderTask->id, [
            'delivery' => $this->currentRequest->input('change_code')
        ]);
    }

    /**
     * 주문 메모 수정.
     * @param String $uuid
     * @return void
     * @throws ClientErrorException
     */
    public function changeMemo(String $uuid): void {
        $orderTask = $this->orderMastersRepository->defaultCustomFind('uuid', $uuid);

        $validator = Validator::make($this->currentRequest->all(), [
            'memo' => 'required'
        ],[
            'memo.required' => '메모를 입력해 주세요.',
        ]);

        if( $validator->fails()) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $this->orderMastersRepository->update($orderTask->id, [
            'memo' => $this->currentRequest->input('memo')
        ]);
    }
}
