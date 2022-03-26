<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use App\Models\ProductCategoryMasters;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\BaseCustomTestCase;

class CategoryDetailTest extends BaseCustomTestCase
{
    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/product/:uuid:/detail-product-category";
    }

    public function test_admin_front_v1_product_category_detail_존재하지_않은_uuid_요청()
    {
        $this->expectException(ModelNotFoundException::class);

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', str_replace(':uuid:', 'asdasdasdasdasdasd', $this->apiURL));
    }

    public function test_admin_front_v1_product_detail_정상_요청()
    {
        $uuid = ProductCategoryMasters::select('uuid')->inRandomOrder()->first()->uuid;

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', str_replace(':uuid:', $uuid, $this->apiURL));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'result' => [
                'uuid',
                'name'
            ]
        ]);
    }
}

