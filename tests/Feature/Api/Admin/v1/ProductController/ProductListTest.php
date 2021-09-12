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

        $this->apiURL = "/api/admin-front/v1/product/show-product/1";
    }

    public function test_admin_front_v1_product_list_요청()
    {
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', $this->apiURL);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'result' => [
                '*' => [
                    "id",
                    "uuid",
                    "name",
                    "category" => [
                        "id",
                        "uuid",
                        "name"
                    ],
                    "options" => [
                        '*' => [
                            "id",
                            "product_id",
                            "color" => [
                                "id",
                                "name",
                            ],
                            "wireless" => [
                                "id",
                                "wireless"
                            ]
                        ],
                    ]
                ],
            ]
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductImages::truncate();
        ProductOptions::truncate();
        ProductMasters::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
