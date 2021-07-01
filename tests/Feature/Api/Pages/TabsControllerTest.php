<?php

namespace Tests\Feature\Api\Pages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class TabsControllerTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_pages_tabs_get_메인_상단_이미지_요청()
    {
        $this->withHeaders($this->getTestApiHeaders())->json('GET', '/api/v1/pages/tabs/main-top')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result'
            ]);
    }

    public function test_pages_tabs_get_메인_카테고리_상품_요청()
    {
        $this->withHeaders($this->getTestApiHeaders())->json('GET', '/api/v1/pages/tabs/main-products-category')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result'
            ]);
    }

    public function test_pages_tabs_get_메인_Best_Item_요청()
    {
        $this->withHeaders($this->getTestApiHeaders())->json('GET', '/api/v1/pages/tabs/main-products-best-items')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result'
            ]);
    }

    public function test_pages_tabs_get_메인_Hot_Item_요청()
    {
        $this->withHeaders($this->getTestApiHeaders())->json('GET', '/api/v1/pages/tabs/main-products-best-items')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result'
            ]);
    }
}
