<?php

namespace Tests\Feature\Api\Admin\v1\SiteManageController;

use App\Exceptions\ClientErrorException;
use App\Models\MediaFileMasters;
use App\Models\NoticeImages;
use App\Models\NoticeMasters;
use Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class NoticeDetailTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/site-manage/:uuid:/detail-notice";
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

    public function test_admin_front_v1_site_manage_notice_detail_uuid_없이_요청()
    {
        $this->expectException(NotFoundHttpException::class);

        $endpoint = str_replace(':uuid:', '', $this->apiURL);
        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', $endpoint);
    }

    public function test_admin_front_v1_site_manage_notice_detail_존재하지_않은_uuid_요청()
    {
        $this->expectException(ModelNotFoundException::class);

        $endpoint = str_replace(':uuid:', 'asdasdasdasdasd', $this->apiURL);
        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', $endpoint);
    }

    public function test_admin_front_v1_site_manage_notice_detail_정상_요청()
    {
        $tmp = NoticeMasters::factory()->count(1)->create()->first()->toArray();
        $imageTask = MediaFileMasters::factory()->create([
            'media_name' => 'site-manage',
            'media_category' => 'notice',
            'dest_path' => '/storage/site-manage/notice/'.sha1(date("Ymd")),
            'file_name' => Helper::uuidSecure().'.jpeg',
            'original_name' => 'test.jpeg',
            'width' => 500,
            'height' => 500,
            'file_type' => 'image/jpeg',
            'file_size' => '106639',
            'file_extension' => 'jpeg',
        ])->first()->toArray();
        NoticeImages::factory()->create([
            'notice_id' => $tmp['id'],
            'media_id' => $imageTask['id']
        ]);

        $task = NoticeMasters::orderBy('id', 'desc')->take(5)->get()->first()->toArray();

        $endpoint = str_replace(':uuid:', $task['uuid'], $this->apiURL);
        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', $endpoint);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "message",
            "result" => [
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
            ]
        ]);
    }
}
