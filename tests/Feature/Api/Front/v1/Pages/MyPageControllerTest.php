<?php

namespace Tests\Feature\Api\Front\v1\Pages;

use App\Models\ProductMasters;
use App\Models\Carts;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class MyPageControllerTest extends BaseCustomTestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

    }

    public function test_front_v1_pages_mypagecontroller_내정보() {

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('GET', "/api/front/v1/pages/my-page/my-info")
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => []
            ]);
    }

    public function test_front_v1_pages_mypagecontroller_내정보_수정() {
        $payload = [
            "auth_index" => "1",
            "password" => "password",
            "zipcode" => "08034",
            "address1" => "서울시 구로구 테스트동 12-3",
            "address2" => "1234호",
            "email" => "test@gmail.com",

        ];

        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('POST', "/api/front/v1/pages/my-page/my-info", $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
            ]);
    }
}
