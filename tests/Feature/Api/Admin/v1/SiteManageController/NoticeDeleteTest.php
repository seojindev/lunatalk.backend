<?php

namespace Tests\Feature\Api\Admin\v1\SiteManageController;

use App\Exceptions\ClientErrorException;
use App\Models\NoticeImages;
use App\Models\NoticeMasters;
use App\Models\ProductCategoryMasters;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class NoticeDeleteTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/site-manage/delete-notice";
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_admin_front_v1_site_manage_notice_delete_uuid_없이_요청()
    {

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin-site-manage.notice.uuid.required'));

        $endpoint = $this->apiURL;
        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', $endpoint);
    }

    public function test_admin_front_v1_site_manage_notice_delete_존재하지_않은_uuid_요청()
    {

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin-site-manage.notice.uuid.exists'));
        $payload = [
            "uuid" => [
                'fasdfasdfasdfasdf1',
                'fasdfasdfasdfasdf2',
                'fasdfasdfasdfasdf3',
                'fasdfasdfasdfasdf4',
            ]
        ];

        $endpoint = $this->apiURL;
        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', $endpoint, $payload);
    }

    public function test_admin_front_v1_site_manage_notice_delete_정상_요청()
    {
        NoticeMasters::factory()->count(1)->create([
            'uuid' => Str::uuid()
        ]);

        $task = NoticeMasters::orderBy('id', 'desc')->take(1)->get()->toArray();

        $uuids = array_map(function($item) {
            return $item['uuid'];
        }, $task);

        $payload = [
            "uuid" => $uuids
        ];

        $endpoint = $this->apiURL;
        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', $endpoint, $payload);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
