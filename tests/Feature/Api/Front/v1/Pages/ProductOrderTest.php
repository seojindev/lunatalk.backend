<?php

namespace Tests\Feature\Api\Front\v1\Pages;

use App\Exceptions\ClientErrorException;
use App\Models\ProductMasters;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class ProductOrderTest extends BaseCustomTestCase
{
    use WithFaker;

    public function setUp(): void {
        parent::setUp();
    }

    public function test_front_v1_pages_product_order_이름없을때()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('order.product.name_required'));

        $this->insertTestProductMaster();
        $this->insertTestProductMaster();

        $products = ProductMasters::take(2)->get()->toArray();

        $payload = [
            'name' => '',
            'zipcode' => $this->faker->numerify('#####'),
            'address1' => "서울 특별시 구로구 부일로100다길 203-1000",
            'address2' => "500호",
            'phone' => $this->faker->numerify('##########'),
            'email' => $this->faker->email(),
            'message' => $this->faker->text(100),
            'product' => array_map(function($item) {
                return $item['uuid'];
            }, $products),
        ];

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('POST', "/api/front/v1/pages/product/order", $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'result' => [
                    'pay_url'
                ]
            ]);
    }

    public function test_front_v1_pages_product_order_우편번호없을때()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('order.product.zipcode_required'));

        $this->insertTestProductMaster();
        $this->insertTestProductMaster();

        $products = ProductMasters::take(2)->get()->toArray();

        $payload = [
            'name' => $this->faker->name,
            'zipcode' => '',
            'address1' => "서울 특별시 구로구 부일로100다길 203-1000",
            'address2' => "500호",
            'phone' => $this->faker->numerify('##########'),
            'email' => $this->faker->email(),
            'message' => $this->faker->text(100),
            'product' => array_map(function($item) {
                return $item['uuid'];
            }, $products),
        ];

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('POST', "/api/front/v1/pages/product/order", $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'result' => [
                    'pay_url'
                ]
            ]);
    }

    public function test_front_v1_pages_product_order_주소없을때()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('order.product.address1_required'));

        $this->insertTestProductMaster();
        $this->insertTestProductMaster();

        $products = ProductMasters::take(2)->get()->toArray();

        $payload = [
            'name' => $this->faker->name,
            'zipcode' => $this->faker->numerify('#####'),
            'address1' => "",
            'address2' => "500호",
            'phone' => $this->faker->numerify('##########'),
            'email' => $this->faker->email(),
            'message' => $this->faker->text(100),
            'product' => array_map(function($item) {
                return $item['uuid'];
            }, $products),
        ];

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('POST', "/api/front/v1/pages/product/order", $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'result' => [
                    'pay_url'
                ]
            ]);
    }

    public function test_front_v1_pages_product_order_상세주소없을때()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('order.product.address2_required'));

        $this->insertTestProductMaster();
        $this->insertTestProductMaster();

        $products = ProductMasters::take(2)->get()->toArray();

        $payload = [
            'name' => $this->faker->name,
            'zipcode' => $this->faker->numerify('#####'),
            'address1' => "서울 특별시 구로구 부일로100다길 203-1000",
            'address2' => "",
            'phone' => $this->faker->numerify('##########'),
            'email' => $this->faker->email(),
            'message' => $this->faker->text(100),
            'product' => array_map(function($item) {
                return $item['uuid'];
            }, $products),
        ];

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('POST', "/api/front/v1/pages/product/order", $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'result' => [
                    'pay_url'
                ]
            ]);
    }

    public function test_front_v1_pages_product_order_휴대폰번호없을때()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('order.product.phone_required'));

        $this->insertTestProductMaster();
        $this->insertTestProductMaster();

        $products = ProductMasters::take(2)->get()->toArray();

        $payload = [
            'name' => $this->faker->name,
            'zipcode' => $this->faker->numerify('#####'),
            'address1' => "서울 특별시 구로구 부일로100다길 203-1000",
            'address2' => "500호",
            'phone' => '',
            'email' => $this->faker->email(),
            'message' => $this->faker->text(100),
            'product' => array_map(function($item) {
                return $item['uuid'];
            }, $products),
        ];

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('POST', "/api/front/v1/pages/product/order", $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'result' => [
                    'pay_url'
                ]
            ]);
    }

    public function test_front_v1_pages_product_order_이메일없을때()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('order.product.email_required'));

        $this->insertTestProductMaster();
        $this->insertTestProductMaster();

        $products = ProductMasters::take(2)->get()->toArray();

        $payload = [
            'name' => $this->faker->name,
            'zipcode' => $this->faker->numerify('#####'),
            'address1' => "서울 특별시 구로구 부일로100다길 203-1000",
            'address2' => "500호",
            'phone' => $this->faker->numerify('##########'),
            'email' => '',
            'message' => $this->faker->text(100),
            'product' => array_map(function($item) {
                return $item['uuid'];
            }, $products),
        ];

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('POST', "/api/front/v1/pages/product/order", $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'result' => [
                    'pay_url'
                ]
            ]);
    }

    public function test_front_v1_pages_product_order_상품없을때()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('order.product.product_required'));

        $this->insertTestProductMaster();
        $this->insertTestProductMaster();

        $products = ProductMasters::take(2)->get()->toArray();

        $payload = [
            'name' => $this->faker->name,
            'zipcode' => $this->faker->numerify('#####'),
            'address1' => "서울 특별시 구로구 부일로100다길 203-1000",
            'address2' => "500호",
            'phone' => $this->faker->numerify('##########'),
            'email' => $this->faker->email(),
            'message' => $this->faker->text(100),
            'product' => [],
        ];

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('POST', "/api/front/v1/pages/product/order", $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'result' => [
                    'pay_url'
                ]
            ]);
    }

    public function test_front_v1_pages_product_order_정상()
    {
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();

        $products = ProductMasters::take(2)->get()->toArray();

        $payload = [
            'name' => $this->faker->name,
            'zipcode' => $this->faker->numerify('#####'),
            'address1' => "서울 특별시 구로구 부일로100다길 203-1000",
            'address2' => "500호",
            'phone' => $this->faker->numerify('##########'),
            'email' => $this->faker->email(),
            'message' => $this->faker->text(100),
            'product' => array_map(function($item) {
                return $item['uuid'];
            }, $products),
        ];

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('POST', "/api/front/v1/pages/product/order", $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'result' => [
                    'pay_url'
                ]
            ]);
    }
}
