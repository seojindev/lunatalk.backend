<?php

namespace Tests\Feature\Api\Admin\v1\SiteManageController;

use App\Exceptions\ClientErrorException;
use App\Models\Codes;
use App\Models\MediaFileMasters;
use App\Models\NoticeImages;
use App\Models\NoticeMasters;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class NoticeUpdateTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/site-manage/:uuid:/update-notice";
    }

    public function test_admin_front_v1_site_manage_notice_update_uuid_없이_요청()
    {
        $this->expectException(NotFoundHttpException::class);

        $endpoint = str_replace(':uuid:', '', $this->apiURL);
        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', $endpoint);
    }

    public function test_admin_front_v1_site_manage_notice_update_카테고리_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin-site-manage.notice.category.required'));


        NoticeMasters::factory()->create();
        $noticeTask = NoticeMasters::orderBy('id', 'desc')->get()->first();

        $payload = [
            'category' => '',
            'title' => '',
            'content' => '',
        ];

        $endpoint = str_replace(':uuid:', $noticeTask->uuid, $this->apiURL);
        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', $endpoint, $payload);
    }

    public function test_admin_front_v1_site_manage_notice_update_존재하지_않은_카테고리_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin-site-manage.notice.category.exists'));

        $payload = [
            'category' => 'asdasd',
            'title' => '',
            'content' => '',
        ];
        NoticeMasters::factory()->create();
        $noticeTask = NoticeMasters::orderBy('id', 'desc')->get()->first();
        $endpoint = str_replace(':uuid:', $noticeTask->uuid, $this->apiURL);
        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', $endpoint, $payload);
    }

    public function test_admin_front_v1_site_manage_notice_update_제목_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin-site-manage.notice.title.required'));

        $payload = [
            'category' => Codes::select('code_id')->whereNotNull('code_id')->where('group_id', '220')->inRandomOrder()->first()->code_id,
            'title' => '',
            'content' => '',
        ];

        NoticeMasters::factory()->create();
        $noticeTask = NoticeMasters::orderBy('id', 'desc')->get()->first();
        $endpoint = str_replace(':uuid:', $noticeTask->uuid, $this->apiURL);
        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', $endpoint, $payload);
    }

    public function test_admin_front_v1_site_manage_notice_update_내용_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin-site-manage.notice.content.required'));

        $payload = [
            'category' => Codes::select('code_id')->whereNotNull('code_id')->where('group_id', '220')->inRandomOrder()->first()->code_id,
            'title' => $this->faker->word(),
            'content' => '',
        ];

        NoticeMasters::factory()->create();
        $noticeTask = NoticeMasters::orderBy('id', 'desc')->get()->first();
        $endpoint = str_replace(':uuid:', $noticeTask->uuid, $this->apiURL);
        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', $endpoint, $payload);
    }

    public function test_admin_front_v1_site_manage_notice_update_정확하지않은_이미지_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin-site-manage.notice.image.integer'));

        $payload = [
            'category' => Codes::select('code_id')->whereNotNull('code_id')->where('group_id', '220')->inRandomOrder()->first()->code_id,
            'title' => $this->faker->word(),
            'content' => $this->faker->text(200),
            'image' => ['asdasd']
        ];

        NoticeMasters::factory()->create();
        $noticeTask = NoticeMasters::orderBy('id', 'desc')->get()->first();
        $endpoint = str_replace(':uuid:', $noticeTask->uuid, $this->apiURL);
        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', $endpoint, $payload);
    }

    public function test_admin_front_v1_site_manage_notice_update_존재하지_않은_이미지_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin-site-manage.notice.image.exists'));

        $payload = [
            'category' => Codes::select('code_id')->whereNotNull('code_id')->where('group_id', '220')->inRandomOrder()->first()->code_id,
            'title' => $this->faker->word(),
            'content' => $this->faker->text(200),
            'image' => ['10000']
        ];

        NoticeMasters::factory()->create();
        $noticeTask = NoticeMasters::orderBy('id', 'desc')->get()->first();
        $endpoint = str_replace(':uuid:', $noticeTask->uuid, $this->apiURL);
        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', $endpoint, $payload);
    }

    public function test_admin_front_v1_site_manage_notice_update_정상_요청()
    {
        $payload = [
            'category' => Codes::select('code_id')->whereNotNull('code_id')->where('group_id', '220')->inRandomOrder()->first()->code_id,
            'title' => $this->faker->word(),
            'content' => $this->faker->text(200),
            'image' => ['1', '2']
        ];

        NoticeMasters::factory()->create();
        $noticeTask = NoticeMasters::orderBy('id', 'desc')->get()->first();
        $endpoint = str_replace(':uuid:', $noticeTask->uuid, $this->apiURL);
        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', $endpoint, $payload);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
