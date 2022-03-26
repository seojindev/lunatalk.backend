<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use App\Models\MediaFileMasters;
use App\Models\ProductBadgeMasters;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class ProductBadgeTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_admin_front_v1_product_badge_create()
    {

        $task = MediaFileMasters::get()->first()->toArray();

        $paylaod = [
            'name' => '테스트 배지',
            'media_id' => $task['id']
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', '/api/admin-front/v1/product/create-product-badge-image', $paylaod);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_admin_front_v1_product_badge_list()
    {

        ProductBadgeMasters::factory()->count(2)->create();

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', '/api/admin-front/v1/product/show-product-badges');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'result' => [
                '*' => [
                    "id",
                    "name",
                    "image" => [
                        "id",
                        "file_name",
                        "url"
                    ]
                ]
            ]
        ]);
    }

    public function test_admin_front_v1_product_badge_update()
    {
        ProductBadgeMasters::factory()->count(2)->create();

        $task = ProductBadgeMasters::get()->first()->toArray();


        $taskFile = MediaFileMasters::get()->first()->toArray();

        $paylaod = [
            'name' => '테스트 배지1',
            'media_id' => $taskFile['id']
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', '/api/admin-front/v1/product/'.$task['id'].'/update-product-badges', $paylaod);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
