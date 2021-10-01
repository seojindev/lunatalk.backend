<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use App\Exceptions\ClientErrorException;
use App\Models\MediaFileMasters;
use App\Models\ProductImages;
use App\Models\ProductMasters;
use App\Models\ProductOptions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\BaseCustomTestCase;

class ProductCreateTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;
    protected array $payload;

    protected string $category = "1";
    protected string $name = "테스트 상품";
    protected string $price = "23000";
    protected string $quantity = "30";
    protected string $memo = "테스트 메모 입니다";
    protected string $sale = "Y";
    protected string $active = "Y";


    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/product/create-product";

        $this->payload = [
            "name" => "테스트 상품",
            "category" => "1",
            "barcode" => "13231231",
            "color" => "1",
            "wireless" => "",
            "price" => "3000",
            "quantity" => "12",
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => ['asdasd'],
            "detail_image" => ""
        ];
    }

    public function test_admin_front_v1_product_create_상품명_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.name.required'));

        $payload = [
            "name" => "",
            "category" => "",
            "barcode" => "",
            "color" => "",
            "wireless" => "",
            "price" => "",
            "quantity" => "",
            "memo" => "",
            "sale" => "",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_create_카테고리_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.category.required'));

        $payload = [
            "name" => "테스트 상품",
            "category" => "",
            "barcode" => "",
            "color" => "",
            "wireless" => "",
            "price" => "",
            "quantity" => "",
            "memo" => "",
            "sale" => "",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_create_존재_하지_않은_카테고리_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.category.exists'));

        $payload = [
            "name" => "테스트 상품",
            "category" => 100000,
            "barcode" => "",
            "color" => "",
            "wireless" => "",
            "price" => "",
            "quantity" => "",
            "memo" => "",
            "sale" => "",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_create_금액_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.price.required'));

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "price" => "",
            "quantity" => "",
            "memo" => "",
            "sale" => "",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_create_수량_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.quantity.required'));

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "price" => 3000,
            "quantity" => "",
            "memo" => "",
            "sale" => "",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_create_판매_상태_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.sale.required'));

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_create_정확하지_않은_판매_상태_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.sale.in'));

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "asdasd",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_create_상품_상태_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.active.required'));

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_create_정확하지_않은_상품_상태_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.active.in'));

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "AA",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_create_옵션_색상_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.color.required'));

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => "",
            "wireless" => "",
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_create_존재_하지_않은_옵션_색상_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.color.exists'));

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => [10000],
            "wireless" => "",
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [1],
            "detail_image" => [1],
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_create_대표_사진_과_상세_사진_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.rep_image.required'));

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => "",
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_create_정상적이지_않은_대표_사진_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.rep_image.integer'));

        $payload = [
            "name" => "테스트 상품",
            "category" => "1",
            "barcode" => "13231231",
            "color" => "1",
            "wireless" => "",
            "price" => "3000",
            "quantity" => "12",
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => ['asdasd'],
            "detail_image" => [1]
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_create_존재하지_않은_대표_사진_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.rep_image.exists'));

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [123123],
            "detail_image" => [1]
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_create_상세_사진_없이_요청()
    {
        $mfm = $this->insertTestRepImage();

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.detail_image.required'));

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [$mfm->id],
            "detail_image" => ""
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);

        MediaFileMasters::where('id', $mfm->id)->forceDelete();
    }

    public function test_admin_front_v1_product_create_정상_적이지_않은_대표_사진_요청()
    {
        $mfm = $this->insertTestRepImage();

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.detail_image.integer'));

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [$mfm->id],
            "detail_image" => ['asdasd']
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);

        MediaFileMasters::where('id', $mfm->id)->forceDelete();
    }

    public function test_admin_front_v1_product_create_존재_하지_않은_대표_사진_요청()
    {
        $mfm = $this->insertTestRepImage();

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.detail_image.exists'));

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => 1,
            "wireless" => "",
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [$mfm->id],
            "detail_image" => [1000000]
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);

        MediaFileMasters::where('id', $mfm->id)->forceDelete();
    }

    public function test_admin_front_v1_product_create_무선_옵션_있을때_요청()
    {
        $rep_mfm = $this->insertTestRepImage();
        $detail_mfm = $this->insertTestDetailImage();

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => [1,2],
            "wireless" => 1,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [$rep_mfm->id],
            "detail_image" => [$detail_mfm->id],
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'result' => [
                'uuid',
            ]
        ]);

        $this->deleteTestRepImage($rep_mfm->id);
        $this->deleteTestDetailImage($detail_mfm->id);
    }

    public function test_admin_front_v1_product_create_옵션_메모_있을때_요청()
    {
        $rep_mfm = $this->insertTestRepImage();
        $detail_mfm = $this->insertTestDetailImage();

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => [1,2],
            "wireless" => 1,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "테스트 메모 입니다.",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [$rep_mfm->id],
            "detail_image" => [$detail_mfm->id],
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'result' => [
                'uuid',
            ]
        ]);

        $this->deleteTestRepImage($rep_mfm->id);
        $this->deleteTestDetailImage($detail_mfm->id);
    }

    public function test_admin_front_v1_product_create_정상_요청()
    {

        $rep_mfm = $this->insertTestRepImage();
        $detail_mfm = $this->insertTestDetailImage();

        $payload = [
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "color" => [1,2],
            "wireless" => 1,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "테스트 메모 입니다.",
            "sale" => "Y",
            "active" => "Y",
            "rep_image" => [$rep_mfm->id],
            "detail_image" => [$detail_mfm->id],
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'result' => [
                'uuid',
            ]
        ]);
        $this->deleteTestRepImage($rep_mfm->id);
        $this->deleteTestDetailImage($detail_mfm->id);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductImages::truncate();
        ProductOptions::truncate();
        ProductMasters::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
