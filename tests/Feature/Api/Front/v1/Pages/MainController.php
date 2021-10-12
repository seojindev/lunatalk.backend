<?php

namespace Tests\Feature\Api\Front\v1\Pages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class MainController extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;
    protected array $testUser;

    public function setUp(): void
    {
        parent::setUp();

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_front_v1_pages_main_메인_슬라이드_요청()
    {
        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', '/api/front/v1/pages/main/main-slide')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => []
            ]);
    }

    public function test_front_v1_pages_main_메인_상품_카테고리_요청()
    {
        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', '/api/front/v1/pages/main/main-slide')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => []
            ]);
    }

    public function test_front_v1_pages_main_메인_베스트_아이템_요청()
    {
        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', '/api/front/v1/pages/main/main-slide')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => []
            ]);
    }

    public function test_front_v1_pages_main_메인_뉴_아이템_요청()
    {
        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', '/api/front/v1/pages/main/main-slide')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => []
            ]);
    }

    public function test_front_v1_pages_main_메인_공지사항_요청()
    {
        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', '/api/front/v1/pages/main/main-slide')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => []
            ]);
    }
}
