<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use App\Exceptions\ClientErrorException;
use App\Models\ProductCategoryMasters;
use App\Models\ProductImages;
use App\Models\ProductMasters;
use App\Models\ProductOptions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class ProductsDeleteTest extends BaseCustomTestCase
{
    protected string $apiURL;

    protected Object $productData;
    protected string $uuid;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/product/delete-products";
    }

    public function test_admin_front_v1_products_delete_uuid_없이_요청()
    {

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.uuid.required'));

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', $this->apiURL);
    }

    public function test_admin_front_v1_products_delete_존재하지_않은_uuid_요청()
    {

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.product.service.uuid.exists'));

        $payload = [
            "uuid" => [
                'fasdfasdfasdfasdf1',
                'fasdfasdfasdfasdf2',
                'fasdfasdfasdfasdf3',
                'fasdfasdfasdfasdf4',
            ]
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_products_delete_정상_요청()
    {
        $payload = [
            "uuid" => array_map(function($item) {
                return $item['uuid'];
            } , ProductMasters::latest(10)->get()->toArray())
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', $this->apiURL, $payload);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);

    }
}
