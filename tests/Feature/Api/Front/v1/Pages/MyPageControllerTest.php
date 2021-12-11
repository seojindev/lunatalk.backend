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
}
