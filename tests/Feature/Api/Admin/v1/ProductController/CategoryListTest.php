<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class CategoryListTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/product/show-product-category";
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_front_v1_product_category_list_요청()
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
                    "products_count"
                ],
            ]
        ]);
    }
}
