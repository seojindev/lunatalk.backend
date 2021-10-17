<?php

namespace Tests\Feature\Api\Front\v1\Pages;

use App\Models\MainSlideMasters;
use App\Models\MainSlides;
use App\Models\MediaFileMasters;
use App\Models\ProductCategoryMasters;
use App\Models\ProductImages;
use App\Models\ProductMasters;
use App\Models\ProductOptions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\BaseCustomTestCase;

class MainControllerTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;
    protected array $testUser;

    public function setUp(): void
    {
        parent::setUp();

    }

    public function test_front_v1_pages_main_메인_슬라이드_요청()
    {
        $mainTask = MainSlideMasters::factory()->create([
            'uuid' => Str::uuid(),
            'name' => $this->faker->word()
        ]);

        MediaFileMasters::factory()->create();

        $lastMedia = MediaFileMasters::latest()->first();

        MainSlides::factory()->create([
            'media_id' => $lastMedia->id,
            'main_slide_id' => $mainTask->id,
            'link' => '/'
        ]);

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', '/api/front/v1/pages/main/main-slide')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => [
                    '*' => [
                        'name',
                        'image' => [
                            'file_name',
                            'url',
                            'width',
                            'height',
                        ]
                    ]
                ]
            ]);
    }

    public function test_front_v1_pages_main_메인_상품_카테고리_요청()
    {
        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', '/api/front/v1/pages/main/main-product-category')
            ->assertStatus(200)
//            ->dump()
            ->assertJsonStructure([
                'message',
                'result' => []
            ]);
    }

//    public function test_front_v1_pages_main_메인_베스트_아이템_요청()
//    {
//        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', '/api/front/v1/pages/main/main-product-best')
//            ->assertStatus(200)
//            ->assertJsonStructure([
//                'message',
//                'result' => []
//            ]);
//    }
//
//    public function test_front_v1_pages_main_메인_뉴_아이템_요청()
//    {
//        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', '/api/front/v1/pages/main/main-product-new-item')
//            ->assertStatus(200)
//            ->assertJsonStructure([
//                'message',
//                'result' => []
//            ]);
//    }
//
//    public function test_front_v1_pages_main_메인_공지사항_요청()
//    {
//        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', '/api/front/v1/pages/main/main-notice')
//            ->assertStatus(200)
//            ->assertJsonStructure([
//                'message',
//                'result' => []
//            ]);
//    }
}