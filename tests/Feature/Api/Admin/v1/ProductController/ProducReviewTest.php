<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use App\Models\ProductImages;
use App\Models\ProductMasters;
use App\Models\ProductOptions;
use App\Models\ProductReviews;
use Illuminate\Support\Facades\DB;
use Tests\BaseCustomTestCase;

class ProducReviewTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();

    }

    public function test_admin_front_v1_product_review_list_요청()
    {
        ProductReviews::factory()->count(10)->create();

//        dd(ProductReviews::all());


        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', "/api/admin-front/v1/product/show-product-reviews");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'result' => [
                '*' => [
                    "id",
                    "user" => [
                        "id",
                        "name",
                        "email"
                    ],
                    "product" => [
                        "id",
                        "uuid",
                        "name"
                    ],
                    "title",
                    "created_at"
                ],
            ]
        ]);
    }

    public function test_admin_front_v1_product_review_상세()
    {

        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();

        $review = ProductReviews::factory()->count(1)->create();
        $review = $review->first()->toArray();

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', "/api/admin-front/v1/product/".$review['id']."/detail-product-reviews");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'result' => [
                "id",
                "user" => [
                    "id",
                    "name",
                    "email"
                ],
                "product" => [
                    "id",
                    "uuid",
                    "name"
                ],
                "title",
                "contents",
                "created_at"
            ]
        ]);
    }

    public function test_admin_front_v1_product_review_답변_등록()
    {

        $this->insertTestProductMaster();

        $review = ProductReviews::factory()->count(1)->create();
        $review = $review->first()->toArray();

        $payload = [
            'title' => '답변 입니다.',
            'contents' => '상품 은 최상의 물건이죠?'
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', "/api/admin-front/v1/product/".$review['id']."/answer-product-review", $payload);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
