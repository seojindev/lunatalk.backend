<?php

namespace Tests\Feature\Api\Service\TabsController;

use App\Exceptions\ClientErrorException;
use App\Models\HomeMains;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class TabClickTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_service_tabs_click_코드값_없이_요청()
    {
        $this->expectException(NotFoundHttpException::class);

        $click_code = "";
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/service/tabs/{$click_code}/click");
    }

    public function test_service_tabs_click_코드값_에러()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('message.other.code_exits'));

        $click_code = "asdasdasdasdas";
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/service/tabs/{$click_code}/click");
    }

    public function test_service_tabs_click_main_top_정상()
    {
        $selectHomeMain = HomeMains::with(['product'])->where('gubun', config('extract.homeMainGubun.mainBestItem.code'))->inRandomOrder()->first()->toArray();

        $click_code = $selectHomeMain['uid'];
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/service/tabs/{$click_code}/click")
            ->assertStatus(204)
            ->assertNoContent();
    }

    public function test_service_tabs_click_main_best_정상()
    {
        $selectHomeMain = HomeMains::with(['product'])->where('gubun', config('extract.homeMainGubun.mainBestItem.code'))->inRandomOrder()->first()->toArray();

        $click_code = $selectHomeMain['uid'];
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/service/tabs/{$click_code}/click")
            ->assertStatus(204)
            ->assertNoContent();
    }

    public function test_service_tabs_click_main_hot_정상()
    {
        $selectHomeMain = HomeMains::with(['product'])->where('gubun', config('extract.homeMainGubun.mainHotItem.code'))->inRandomOrder()->first()->toArray();

        $click_code = $selectHomeMain['uid'];
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/service/tabs/{$click_code}/click")
            ->assertStatus(204)
            ->assertNoContent();
    }

    public function test_service_tabs_click_product_category_정상()
    {

        $randCategoryKey = array_rand(config('extract.productCategory'), 1);

        $randCategoryCode = config("extract.productCategory.{$randCategoryKey}.code");

        $click_code = $randCategoryCode;
        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', "/api/v1/service/tabs/{$click_code}/click")
            ->assertStatus(204)
            ->assertNoContent();
    }


}
