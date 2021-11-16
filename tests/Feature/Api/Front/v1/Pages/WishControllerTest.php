<?php

namespace Tests\Feature\Api\Front\v1\Pages;

use App\Models\ProductMasters;
use App\Models\Wishs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class WishControllerTest extends BaseCustomTestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

    }

    public function test_front_v1_pages_wishcontroller_생성() {

        $product = ProductMasters::first()->toArray();

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('POST', "/api/front/v1/pages/wish/${product['uuid']}/create")
            ->assertStatus(201)
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function test_front_v1_pages_wishcontroller_리스트() {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_front_v1_pages_wishcontroller_삭제() {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_front_v1_pages_wishcontroller_삭제_복수() {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


}
