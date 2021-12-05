<?php

namespace Tests\Feature\Api\Front\v1\Etc;

use App\Models\ProductMasters;
use App\Models\ProductReviews;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class ProductControllerTest extends BaseCustomTestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

    }

    public function test_front_v1_pages_etc_전체_상품_리스트()
    {
        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('GET', '/api/front/v1/product/total-products')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => [
                    '*' => [
                        "id",
                        "uuid",
                        "name",
                        "quantity" => [
                            "number",
                            "string"
                        ],
                        "original_price" => [
                            "number",
                            "string"
                        ],
                        "price" => [
                            "number",
                            "string"
                        ],
                        "category" => [
                            "id",
                            "uuid",
                            "name"
                        ],
                        "color" => [
                            '*' => [
                                "id",
                                "name"
                            ]
                        ],
                        'wireless' => [
                            'id',
                            'wireless'
                        ],
                        "badge" => [
                            '*' => [
                                "id",
                                "name",
                                "image" => [
                                    "id",
                                    "file_name",
                                    "url"
                                ]
                            ]
                        ],
                        "best_item",
                        "new_item",
                        "rep_images" => [
                            '*' => [
                                "id",
                                "file_name",
                                "url"
                            ]
                        ],
                        "detail_images" => [
                            '*' => [
                                "id",
                                "file_name",
                                "url"
                            ]
                        ]
                    ]
                ]
            ]);
    }

    public function test_front_v1_pages_etc_전체_상품_상세()
    {

        $this->insertTestProductMaster();


        $pcm = ProductMasters::inRandomOrder()->first();
        $uuid = $pcm->uuid;

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('GET', 'api/front/v1/product/'.$uuid.'/detail')
            ->assertStatus(200)
//            ->dump()
            ->assertJsonStructure([
                'message',
                'result' => [

                ]
            ]);
    }

    public function test_front_v1_pages_etc_검색()
    {

        $this->insertTestProductMaster();
        $pcm = ProductMasters::inRandomOrder()->first();
        $name = urlencode($pcm->name);

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('GET', '/api/front/v1/product/'.$name.'/search-list')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => [
                    '*' => [
                        "uuid",
                        "name",
                        "original_price" => [
                            "number",
                            "string"
                        ],
                        "price" => [
                            "number",
                            "string"
                        ],
                        "color",
                        "review_count" => [
                            "number",
                            "string"
                        ],
                        "rep_image" => [
                            "file_name",
                            "url"
                        ]
                    ]
                ]
            ]);
    }

    public function test_front_v1_pages_etc_회원_리뷰_등록()
    {

        $requestHeader = $this->getTestNormalAccessTokenHeader();

        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();

        $product = ProductMasters::inRandomOrder()->get()->first()->toArray();


        $payload = [
            'title' => '리뷰 제목 입니다.',
            'review' => '안녕하세요 너무 잘 맞네요 감사합니다.',
        ];

        $this->withHeaders($requestHeader)->json('POST', '/api/front/v1/product/'.$product['uuid'].'/create-review', $payload)
            ->assertStatus(201)
//            ->dump()
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function test_front_v1_pages_etc_회원_리뷰_리스트()
    {

        $this->insertTestProductMaster();
        $pcm = ProductMasters::inRandomOrder()->first();

        ProductReviews::factory()->create([
            'product_id' => $pcm->id
        ]);

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('GET', '/api/front/v1/product/'.$pcm->uuid.'/list-review')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => [
                    '*' => [
                        "id",
                        "title",
                        "content",
                        "user_name",
                        "created_at",
                        "answer"
                    ]
                ]
            ]);
    }
}
