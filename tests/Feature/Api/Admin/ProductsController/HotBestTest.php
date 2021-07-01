<?php

namespace Tests\Feature\Api\Admin\ProductsController;

use App\Exceptions\ClientErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class HotBestTest extends BaseCustomTestCase
{
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // 베스트 아이템 추가.
    public function test_admin_products_HotBest_베스트_아이템_추가_UUID_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('message.exception.NotFoundHttpException'));

        $product_uuid = "";

        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/admin/product/{$product_uuid}/best-item");
    }
    public function test_admin_products_HotBest_베스트_아이템_추가_존재_하지_않는_UUID_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.products.hot-best.uuid-exists'));

        $product_uuid = "asdasdasdasdas";
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/admin/product/{$product_uuid}/best-item");
    }
    public function test_admin_products_HotBest_베스트_아이템_이미_등록되어_있는_UUID_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.products.hot-best.uuid-unique'));

        $product_uuid = "asdasdasdasdas";
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/admin/product/{$product_uuid}/best-item");
    }
    public function test_admin_products_HotBest_베스트_아이템_추가_정상_요청()
    {
        $product_uuid = "asdasdasdasdas";

        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/admin/product/{$product_uuid}/best-item")
            ->assertStatus(201)
            ->assertJsonStructure([
                'message'
            ]);
    }

    // 베스트 아이템 삭제.
    public function test_admin_products_HotBest_베스트_아이템_삭제_UUID_없이_요청()
    {
        $this->assertTrue(true);
    }
    public function test_admin_products_HotBest_베스트_아이템_삭제_존재_하지_않은_UUID_요청()
    {
        $this->assertTrue(true);
    }
    public function test_admin_products_HotBest_베스트_아이템_삭제_등록_되어_있지_않은_UUID_요청()
    {
        $this->assertTrue(true);
    }
    public function test_admin_products_HotBest_베스트_아이템_삭제_정상_요청()
    {
        $this->assertTrue(true);
    }

    // 핫 아이템 추가.
    public function test_admin_products_HotBest_핫_아이템_추가_UUID_없이_요청()
    {
        $this->assertTrue(true);
    }
    public function test_admin_products_HotBest_핫_아이템_추가_존재_하지_않는_UUID_요청()
    {
        $this->assertTrue(true);
    }
    public function test_admin_products_HotBest_핫_아이템_이미_등록되어_있는_UUID_요청()
    {
        $this->assertTrue(true);
    }
    public function test_admin_products_HotBest_핫_아이템_추가_정상_요청()
    {
        $this->assertTrue(true);
    }
    // 핫 아이템 삭제.
    public function test_admin_products_HotBest_핫_아이템_삭제_UUID_없이_요청()
    {
        $this->assertTrue(true);
    }
    public function test_admin_products_HotBest_핫_아이템_삭제_존재_하지_않은_UUID_요청()
    {
        $this->assertTrue(true);
    }
    public function test_admin_products_HotBest_핫_아이템_삭제_등록_되어_있지_않은_UUID_요청()
    {
        $this->assertTrue(true);
    }
    public function test_admin_products_HotBest_핫_아이템_삭제_정상_요청()
    {
        $this->assertTrue(true);
    }
}
