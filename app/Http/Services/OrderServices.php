<?php

namespace App\Http\Services;

use App\Exceptions\ClientErrorException;
use App\Http\Repositories\Eloquent\ProductMastersRepository;
use App\Http\Repositories\Eloquent\OrderMastersRepository;
use App\Http\Repositories\Eloquent\OrderAddressRepository;
use App\Http\Repositories\Eloquent\OrderProductsRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OrderServices {

    /**
     * @var Request
     */
    protected Request $currentRequest;

    /**
     * @var ProductMastersRepository
     */
    protected ProductMastersRepository $productMastersRepository;

    /**
     * @var OrderMastersRepository
     */
    protected OrderMastersRepository $orderMastersRepository;

    /**
     * @var OrderAddressRepository
     */
    protected OrderAddressRepository $orderAddressRepository;

    /**
     * @var OrderProductsRepository
     */
    protected OrderProductsRepository $orderProductsRepository;

    /**
     * @param Request $currentRequest
     * @param ProductMastersRepository $productMastersRepository
     * @param OrderMastersRepository $orderMastersRepository
     * @param OrderAddressRepository $orderAddressRepository
     * @param OrderProductsRepository $orderProductsRepository
     */
    function __construct(Request $currentRequest, ProductMastersRepository $productMastersRepository, OrderMastersRepository $orderMastersRepository, OrderAddressRepository $orderAddressRepository, OrderProductsRepository $orderProductsRepository) {
        $this->currentRequest = $currentRequest;

        $this->productMastersRepository = $productMastersRepository;
        $this->orderAddressRepository = $orderAddressRepository;
        $this->orderMastersRepository = $orderMastersRepository;
        $this->orderProductsRepository = $orderProductsRepository;
    }

    /**
     * 상품 오더 처리.
     * @return string[]
     * @throws ClientErrorException
     */
    public function productNewOrder() : array {

        $validator = Validator::make($this->currentRequest->all(), [
            'name' => 'required',
            'zipcode' => 'required|numeric|digits_between:4,7',
            'address1' => 'required',
            'address2' => 'required',
            'phone' => 'required|numeric|digits_between:8,11',
            'email' => 'required|email',
            'message' => 'required',
            'product' => 'required|array|min:1',
            'product.*' => 'exists:product_masters,uuid'
        ],
            [
                'name.required' => __('order.product.name_required'),
                'zipcode.required' => __('order.product.zipcode_required'),
                'zipcode.numeric' => __('order.product.zipcode_required'),
                'zipcode.digits_between' => __('order.product.zipcode_digits_between'),
                'address1.required' => __('order.product.address1_required'),
                'address2.required' => __('order.product.address2_required'),
                'phone.required' => __('order.product.phone_required'),
                'phone.numeric' => __('order.product.phone_number'),
                'phone.digits_between' => __('order.product.phone_digits_between'),
                'email.required' => __('order.product.email_required'),
                'email.email' => __('order.product.email_email'),
                'product.required' => __('order.product.product_required'),
                'product.array' => __('order.product.product_array'),
                'product.*.exists' => __('order.product.product_exitsts'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $user_id = Auth()->id();

        $orderUUID = \Helper::randomNumberUUID();

        $master = $this->orderMastersRepository->create([
            'uuid' => $orderUUID,
            'user_id' => $user_id,
            'name' => $this->currentRequest->input('name'),
            'phone' => $this->currentRequest->input('phone'),
            'email' => $this->currentRequest->input('email'),
            'message' => $this->currentRequest->input('message'),
            'order_name' => '',
            'order_price' => 0
        ]);

        $this->orderAddressRepository->create([
            'order_id' => $master->id,
            'zipcode' => $this->currentRequest->input('zipcode'),
            'step1' => $this->currentRequest->input('address1'),
            'step2' => $this->currentRequest->input('address2')
        ]);

        $orderName = "";
        $orderPrice = 0;
        foreach ($this->currentRequest->input('product') as $uuid) :
            $task = $this->productMastersRepository->defaultCustomFind('uuid', $uuid);
            $this->orderProductsRepository->create([
                'order_id' => $master->id,
                'product_id' => $task->id,
                'price' => $task->price
            ]);
            $orderPrice = $orderPrice + $task->price;
            if(empty($orderName)) {
                $orderName = $task->name;
            }
        endforeach;

        if(count($this->currentRequest->input('product')) > 1) {
            $orderName =  $orderName.' 외' . (count($this->currentRequest->input('product'))-1) . '건';
        }

        $this->orderMastersRepository->update($master->id, [
            'order_name' => $orderName,
            'order_price' => $orderPrice
        ]);

        return [
            'pay_url' => env('APP_PAY_URL') . '/v1/order' . '?uuid=' . $orderUUID
        ];
    }
}
