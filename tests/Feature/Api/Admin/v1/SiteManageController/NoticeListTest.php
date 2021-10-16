<?php

namespace Tests\Feature\Api\Admin\v1\SiteManageController;

use App\Models\NoticeImages;
use App\Models\NoticeMasters;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\BaseCustomTestCase;

class NoticeListTest extends BaseCustomTestCase
{
    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/site-manage/show-notice";
    }

    public function test_admin_front_v1_site_manage_notice_list_정상_요청()
    {
        NoticeMasters::factory()->count(10)->create();
        NoticeImages::factory()->count(20)->create();

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', $this->apiURL);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'result' => [
                '*' => [
                    "uuid",
                    "category" => [
                        "code_id",
                        "code_name"
                    ],
                    "title",
                    "content" => [
                        "default"
                    ],
                    "active",
                    "images"
                    ,
                ]
            ]
        ]);
    }
}
