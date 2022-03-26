<?php

namespace Tests\Feature\Api\Front\v1\Pages;

use App\Models\ProductMasters;
use App\Models\Carts;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class CartControllerTest extends BaseCustomTestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

    }

    public function test_front_v1_pages_cartcontroller_생성() {

        $product = ProductMasters::first()->toArray();

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('POST', "/api/front/v1/pages/cart/${product['uuid']}/create")
            ->assertStatus(201)
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function test_front_v1_pages_cartcontroller_리스트() {

        $requestHeader = $this->getTestNormalAccessTokenHeader();

        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();

        $product_id_list = ProductMasters::inRandomOrder()->get()->toArray();

        foreach ($product_id_list as $product_id) :
            Carts::create([
                'user_id' => $requestHeader['user_id'],
                'product_id' => $product_id['id']
            ]);
        endforeach;

        $this->withHeaders($requestHeader)->json('GET', '/api/front/v1/pages/cart/list')
            ->assertStatus(200)
//            ->dump()
            ->assertJsonStructure([
                'message',
                'result' => [
                    '*' => [
                        'cart_id',
                        'product_uuid',
                        'name',
                        'price' => [
                            'number',
                            'string',
                        ],
                        'rep_image' => [
                            'id',
                            'file_name',
                            'url'
                        ],
                    ]
                ]
            ]);
    }

    public function test_front_v1_pages_cartcontroller_삭제() {
        $requestHeader = $this->getTestNormalAccessTokenHeader();

        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();

        $product_id_list = ProductMasters::inRandomOrder()->get()->toArray();

        foreach ($product_id_list as $product_id) :
            Carts::create([
                'user_id' => $requestHeader['user_id'],
                'product_id' => $product_id['id']
            ]);
        endforeach;

        $cart = Carts::where('user_id', $requestHeader['user_id'])->get()->first()->toArray();

        $cart_id = $cart['id'];

        $this->withHeaders($requestHeader)->json('DELETE', '/api/front/v1/pages/cart/'.$cart_id.'/delete')
            ->assertStatus(200)
//            ->dump()
            ->assertJsonStructure([
                'message',
            ]);

    }


    public function test_front_v1_pages_cartcontroller_삭제_복수() {
        $requestHeader = $this->getTestNormalAccessTokenHeader();

        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();

        $product_id_list = ProductMasters::inRandomOrder()->get()->toArray();

        foreach ($product_id_list as $product_id) :
            Carts::create([
                'user_id' => $requestHeader['user_id'],
                'product_id' => $product_id['id']
            ]);
        endforeach;

        $carts = Carts::where('user_id', $requestHeader['user_id'])->get()->take(3)->toArray();

        $payload = [];
        foreach ($carts as $cart):
            $payload[] = $cart['id'];
        endforeach;

        $this->withHeaders($requestHeader)->json('DELETE', '/api/front/v1/pages/cart/many-delete', $payload)
            ->assertStatus(200)
//            ->dump()
            ->assertJsonStructure([
                'message',
            ]);
    }


}
