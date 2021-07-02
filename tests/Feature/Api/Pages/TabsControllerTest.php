<?php

namespace Tests\Feature\Api\Pages;

use App\Models\HomeMains;
use App\Models\ProductImages;
use App\Models\ProductOptions;
use App\Models\Products;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class TabsControllerTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_pages_tabs_get_메인_상단_이미지_데이터_없을떄_요청()
    {
        HomeMains::truncate();

        $this->expectException(ModelNotFoundException::class);
        $this->withHeaders($this->getTestApiHeaders())->json('GET', '/api/v1/pages/tabs/main-top');
    }

    public function test_pages_tabs_get_메인_상단_이미지_정상_요청()
    {
        HomeMains::factory(20)->create();

        $this->withHeaders($this->getTestApiHeaders())->json('GET', '/api/v1/pages/tabs/main-top')
            ->assertStatus(200)
//            ->dump()
            ->assertJsonStructure([
                'message',
                'result' => [
                    '*' => [
                        "product_name",
                        "product_uuid",
                        "product_image",
                    ]
                ]
            ]);
    }

    public function test_pages_tabs_get_메인_카테고리_상품_데이터_없을떄_요청()
    {
        Products::truncate();
        $this->expectException(ModelNotFoundException::class);
        $this->withHeaders($this->getTestApiHeaders())->json('GET', '/api/v1/pages/tabs/main-products-category');
    }

    public function test_pages_tabs_get_메인_카테고리_상품_정상_요청()
    {
        Products::truncate();

        foreach (config('extract.productCategory') as $categoryItem):
            Products::factory(4)->create([
                'category' => $categoryItem['code']
            ]);

            foreach (Products::all()->toArray() as $product) :
                ProductOptions::factory(1)->create([
                    'product_id' => $product['id']
                ]);
                ProductImages::factory(1)->create([
                    'product_id' => $product['id'],
                    'media_category' => 'G010010'
                ]);
                ProductImages::factory(3)->create([
                    'product_id' => $product['id'],
                    'media_category' => 'G010020'
                ]);
            endforeach;
        endforeach;

        $this->withHeaders($this->getTestApiHeaders())->json('GET', '/api/v1/pages/tabs/main-products-category')
            ->assertStatus(200)
//            ->dump()
            ->assertJsonStructure([
                'message',
                'result' => [
                    '*' => [
                        "product_name",
                        "product_uuid",
                        "product_image",
                    ]
                ]
            ]);

    }

    public function test_pages_tabs_get_메인_Best_Item_데이터_없을떄_요청()
    {
        HomeMains::truncate();

        $this->expectException(ModelNotFoundException::class);
        $this->withHeaders($this->getTestApiHeaders())->json('GET', '/api/v1/pages/tabs/main-products-best-items');
    }

    public function test_pages_tabs_get_메인_Best_Item_정상_요청()
    {
        HomeMains::factory(30)->create();

        $this->withHeaders($this->getTestApiHeaders())->json('GET', '/api/v1/pages/tabs/main-products-best-items')
            ->assertStatus(200)
//            ->dump()
            ->assertJsonStructure([
                'message',
                'result' => [
                    '*' => [
                        "product_name",
                        "product_uuid",
                        "product_image",
                    ]
                ]
            ]);
    }

    public function test_pages_tabs_get_메인_Hot_Item_데이터_없을떄_요청()
    {
        HomeMains::truncate();

        $this->expectException(ModelNotFoundException::class);
        $this->withHeaders($this->getTestApiHeaders())->json('GET', '/api/v1/pages/tabs/main-products-best-items');
    }

    public function test_pages_tabs_get_메인_Hot_Item_정상_요청()
    {
        HomeMains::factory(30)->create();

        $this->withHeaders($this->getTestApiHeaders())->json('GET', '/api/v1/pages/tabs/main-products-best-items')
            ->assertStatus(200)
//            ->dump()
            ->assertJsonStructure([
                'message',
                'result' => [
                    '*' => [
                        "product_name",
                        "product_uuid",
                        "product_image",
                    ]
                ]
            ]);
    }
}
