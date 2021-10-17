<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use App\Models\ProductImages;
use App\Models\ProductMasters;
use App\Models\ProductOptions;
use Illuminate\Support\Facades\DB;
use Tests\BaseCustomTestCase;

class ProductListTest extends BaseCustomTestCase
{
    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/product/show-product";
    }

    public function test_admin_front_v1_product_list_요청()
    {
        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', $this->apiURL);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'result' => [
                '*' => [
                    "id",
                    "uuid",
                    "name",
                    "quantity" => [
                        'number',
                        'string'
                    ],
                    "price" => [
                        'number',
                        'string'
                    ],
                    "category" => [
                        "id",
                        "uuid",
                        "name"
                    ],
                    'color' => [
                        '*' => [
                            'name',
                        ]
                    ],
                    'wireless' => [
                        '*' => [
                            'wireless'
                        ]
                    ],
                ],
            ]
        ]);
    }
}
