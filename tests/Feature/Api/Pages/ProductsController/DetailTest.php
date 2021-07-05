<?php

namespace Tests\Feature\Api\Pages\ProductsController;

use App\Exceptions\ClientErrorException;
use App\Models\Products;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class DetailTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

//    public function test_example()
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }

    public function test_pages_products_detail_uuid_에러()
    {
        $this->expectException(NotFoundHttpException::class);

        $product_uuid = '';
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/pages/products/{$product_uuid}/detail");
    }

    public function test_pages_products_detail_존재_하지_않은_상품()
    {
        $this->expectException(ModelNotFoundException::class);

        $product_uuid = '12312312312-12312312312-12312312312';

        $this->withHeaders($this->getTestApiHeaders())->json('GET', "/api/v1/pages/products/{$product_uuid}/detail");
    }

//    public function test_pages_products_detail_판매_중지된_상품()
//    {
//        $product = Products::select()->inRandomOrder()->first()->toArray();
//
//        Products::where('id', $product['id'])->update([
//            'sale' => 'N'
//        ]);
//
//        $this->expectException(ClientErrorException::class);
//        $this->expectExceptionMessage(__('message.product.detail.sale_stop'));
//
//        $product_uuid = $product['uuid'];
//
//        $this->withHeaders($this->getTestApiHeaders())->json('GET', "/api/v1/pages/products/{$product_uuid}/detail");
//    }

    public function test_pages_products_detail_정상()
    {
        $product = Products::select()->inRandomOrder()->first()->toArray();
        $product_uuid = $product['uuid'];

        $this->withHeaders($this->getTestApiHeaders())->json('GET', "/api/v1/pages/products/{$product_uuid}/detail")
//            ->dump()
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => [
                    'uuid',
                    'category' => [
                        'code_id',
                        'code_name'
                    ],
                    'name',
                    'full_name',
                    'price' => [
                        'type1',
                        'type2'
                    ],
                    'stock'=> [
                        'type1',
                        'type2'
                    ],
                    'sale',
                    'active',
                    'options' => [
                        'step1' => [
                            'code_id',
                            'name_name'
                        ],
                    ],
                    'images' => [
                        'repImage' => [
                            'name',
                            'list' => [
                                '*' => [
                                    'media_id',
                                    'original_name',
                                    'url',
                                    'thumb_url',
                                    'size'
                                ]
                            ],
                        ],
                        'detailImage' => [
                            'name',
                            'list' => [
                                '*' => [
                                    'media_id',
                                    'original_name',
                                    'url',
                                    'size'
                                ]
                            ]
                        ]
                    ],
                ]
            ]);
    }
}
