<?php

namespace Tests\Feature\Api\Admin\ProductsController;

use App\Exceptions\ClientErrorException;
use App\Models\HomeMains;
use App\Models\Products;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;


class HotBestTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    // 베스트 아이템 추가.
    public function test_admin_products_HotBest_베스트_아이템_추가_UUID_없이_요청()
    {
        $this->expectException(NotFoundHttpException::class);

        $product_uuid = "";
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/admin/product/{$product_uuid}/best-item");
    }
    public function test_admin_products_HotBest_베스트_아이템_추가_존재_하지_않는_상품_UUID_요청()
    {
        $this->expectException(ModelNotFoundException::class);
        $product_uuid = "asdasdasdasdas";
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/admin/product/{$product_uuid}/best-item");
    }
    public function test_admin_products_HotBest_베스트_아이템_이미_등록되어_있는_UUID_요청()
    {
        $selectHomeMain = HomeMains::with(['product'])->where('gubun', config('extract.homeMainGubun.mainBestItem.code'))->inRandomOrder()->first()->toArray();

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.products.hot-best.uuid-unique'));

        $product_uuid = $selectHomeMain['product']['uuid'];
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/admin/product/{$product_uuid}/best-item");
    }
    public function test_admin_products_HotBest_베스트_아이템_추가_정상_요청()
    {
        $tempProductName = 'test product';

        Products::factory(1)->create([
            'name' => $tempProductName
        ]);

        $selectProduct = Products::where('name', $tempProductName)->first()->toArray();
        $product_uuid = $selectProduct['uuid'];

        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/admin/product/{$product_uuid}/best-item")
            ->assertStatus(201)
            ->assertJsonStructure([
                'message'
            ]);
    }

    // 베스트 아이템 삭제.
    public function test_admin_products_HotBest_베스트_아이템_삭제_UUID_없이_요청()
    {
        $this->expectException(NotFoundHttpException::class);

        $product_uuid = '';
        $this->withHeaders($this->getTestAccessTokenHeader())->json('DELETE', "/api/v1/admin/product/{$product_uuid}/best-item");
    }
    public function test_admin_products_HotBest_베스트_아이템_삭제_존재_하지_않은_상품_UUID_요청()
    {
        $this->expectException(ModelNotFoundException::class);
        $product_uuid = 'asdasdasdasdas';
        $this->withHeaders($this->getTestAccessTokenHeader())->json('DELETE', "/api/v1/admin/product/{$product_uuid}/best-item");
    }
    public function test_admin_products_HotBest_베스트_아이템_삭제_등록_되어_있지_않은_UUID_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.products.hot-best.uuid-exists'));

        $tempProductName = 'test product';

        Products::factory(1)->create([
            'name' => $tempProductName
        ]);

        $selectProduct = Products::where('name', $tempProductName)->first()->toArray();
        $product_uuid = $selectProduct['uuid'];

        $this->withHeaders($this->getTestAccessTokenHeader())->json('DELETE', "/api/v1/admin/product/{$product_uuid}/best-item");

    }
    public function test_admin_products_HotBest_베스트_아이템_삭제_정상_요청()
    {
        $selectHomeMain = HomeMains::with(['product'])->where('gubun', config('extract.homeMainGubun.mainBestItem.code'))->inRandomOrder()->first()->toArray();
        $product_uuid = $selectHomeMain['product']['uuid'];

        $this->withHeaders($this->getTestAccessTokenHeader())->json('DELETE', "/api/v1/admin/product/{$product_uuid}/best-item")
            ->assertStatus(202)
            ->assertJsonStructure([
                'message'
            ]);
    }

    // 핫 아이템 추가.
    public function test_admin_products_HotBest_핫_아이템_추가_UUID_없이_요청()
    {
        $this->expectException(NotFoundHttpException::class);

        $product_uuid = '';
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/admin/product/{$product_uuid}/hot-item");
    }
    public function test_admin_products_HotBest_핫_아이템_추가_존재_하지_않는_UUID_요청()
    {
        $this->expectException(ModelNotFoundException::class);
        $product_uuid = 'asdasdasdasdas';
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/admin/product/{$product_uuid}/hot-item");
    }
    public function test_admin_products_HotBest_핫_아이템_이미_등록되어_있는_UUID_요청()
    {
        $selectHomeMain = HomeMains::with(['product'])->where('gubun', config('extract.homeMainGubun.mainHotItem.code'))->inRandomOrder()->first()->toArray();

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.products.hot-best.uuid-unique'));

        $product_uuid = $selectHomeMain['product']['uuid'];
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/admin/product/{$product_uuid}/hot-item");
    }
    public function test_admin_products_HotBest_핫_아이템_추가_정상_요청()
    {
        $tempProductName = 'test product';

        Products::factory(1)->create([
            'name' => $tempProductName
        ]);

        $selectProduct = Products::where('name', $tempProductName)->first()->toArray();
        $product_uuid = $selectProduct['uuid'];

        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/admin/product/{$product_uuid}/hot-item")
            ->assertStatus(201)
            ->assertJsonStructure([
                'message'
            ]);
    }

    // 핫 아이템 삭제.
    public function test_admin_products_HotBest_핫_아이템_삭제_UUID_없이_요청()
    {
        $this->expectException(NotFoundHttpException::class);

        $product_uuid = '';
        $this->withHeaders($this->getTestAccessTokenHeader())->json('DELETE', "/api/v1/admin/product/{$product_uuid}/hot-item");
    }
    public function test_admin_products_HotBest_핫_아이템_삭제_존재_하지_않은_UUID_요청()
    {
        $this->expectException(ModelNotFoundException::class);
        $product_uuid = 'asdasdasdasdas';
        $this->withHeaders($this->getTestAccessTokenHeader())->json('DELETE', "/api/v1/admin/product/{$product_uuid}/hot-item");
    }
    public function test_admin_products_HotBest_핫_아이템_삭제_등록_되어_있지_않은_UUID_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.products.hot-best.uuid-exists'));

        $tempProductName = 'test product';

        Products::factory(1)->create([
            'name' => $tempProductName
        ]);

        $selectProduct = Products::where('name', $tempProductName)->first()->toArray();
        $product_uuid = $selectProduct['uuid'];

        $this->withHeaders($this->getTestAccessTokenHeader())->json('DELETE', "/api/v1/admin/product/{$product_uuid}/hot-item");
    }
    public function test_admin_products_HotBest_핫_아이템_삭제_정상_요청()
    {
        $selectHomeMain = HomeMains::with(['product'])->where('gubun', config('extract.homeMainGubun.mainHotItem.code'))->inRandomOrder()->first()->toArray();
        $product_uuid = $selectHomeMain['product']['uuid'];

        $this->withHeaders($this->getTestAccessTokenHeader())->json('DELETE', "/api/v1/admin/product/{$product_uuid}/hot-item")
            ->assertStatus(202)
            ->assertJsonStructure([
                'message'
            ]);
    }
}
