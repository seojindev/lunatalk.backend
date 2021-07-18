<?php

namespace Tests\Feature\Api\Service\ProductsController;

use App\Models\ProductOptions;
use App\Models\Products;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class ListTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_service_products_total_list_페이징()
    {
        $this->withHeaders($this->getTestAccessTokenHeader())->json('GET', "/api/v1/service/products/total-list-paging/1")
//            ->dump()
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => [
                    'current_page',
                    'per_page',
                    'has_more',
                    'from',
                    'to',
                    'products' => [
                        '*' => [
                            'id',
                            'uuid',
                            'category' => [
                                'code_id',
                                'code_name'
                            ],
                            'name',
                            'full_name',
                            'options' => [
                                'step1' => [
                                    'code_id',
                                    'name_name'
                                ]
                            ],
                            'rep_image' => [
                                'path',
                                'url',
                                'thumb_url'
                            ]
                        ]
                    ]
                ]
            ]);
    }
}
