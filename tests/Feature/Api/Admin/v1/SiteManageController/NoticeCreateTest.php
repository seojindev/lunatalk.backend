<?php

namespace Tests\Feature\Api\Admin\v1\SiteManageController;

use App\Exceptions\ClientErrorException;
use App\Models\Codes;
use App\Models\MediaFileMasters;
use App\Models\NoticeImages;
use App\Models\NoticeMasters;
use Helper;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\BaseCustomTestCase;

class NoticeCreateTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/site-manage/create-notice";
    }

    public function test_admin_front_v1_site_manage_notice_create_factory_테스트()
    {
        $data = [
            'category' => Codes::select('code_id')->whereNotNull('code_id')->where('group_id', '220')->inRandomOrder()->first()->code_id,
            'title' => $this->faker->unique()->word(),
            'content' => $this->faker->unique()->text(200),
            'active' => 'Y'
        ];

        $taskNotice = NoticeMasters::factory()->create($data);

        $taskImage = MediaFileMasters::factory()->create([
            'media_name' => 'manage',
            'media_category' => 'notice',
            'dest_path' => '/storage/manage/'.'/notice/'.sha1(date("Ymd")),
            'file_name' => Helper::uuidSecure().'.jpeg',
            'original_name' => Helper::uuidSecure().'.jpeg',
            'width' => '500',
            'height' => '500',
            'file_type' => 'image/jpeg',
            'file_size' => '106639',
            'file_extension' => 'jpeg',
        ]);

        $imageData = [
            'notice_id' => $taskNotice->id,
            'media_id' => $taskImage->id,
            'active' => 'Y'
        ];

        NoticeImages::factory()->create($imageData);

        $this->assertDatabaseHas('notice_masters', $data);
        $this->assertDatabaseHas('notice_images', $imageData);

    }

    // 카테고리 없이 요청
    public function test_admin_front_v1_site_manage_notice_create_카테고리_없이_요청() {

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin-site-manage.notice.category.required'));

        $payload['category'] = '';
        $payload['title'] = '';
        $payload['content'] = '';

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    // 존재 하지 않은 카테고리.
    public function test_admin_front_v1_site_manage_notice_create_존재_하지_않은_카테고리_요청() {

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin-site-manage.notice.category.exists'));

        $payload['category'] = 'asdfasdf';
        $payload['title'] = '';
        $payload['content'] = '';

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    // 제목 없이 요청.
    public function test_admin_front_v1_site_manage_notice_create_제목_없이_요청() {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin-site-manage.notice.title.required'));

        $payload['category'] = Codes::select('code_id')->whereNotNull('code_id')->where('group_id', '220')->inRandomOrder()->first()->code_id;
        $payload['title'] = '';
        $payload['content'] = '';

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    // 내용 없이 요청.
    public function test_admin_front_v1_site_manage_notice_create_내용_없이_요청() {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin-site-manage.notice.content.required'));

        $payload['category'] = Codes::select('code_id')->whereNotNull('code_id')->where('group_id', '220')->inRandomOrder()->first()->code_id;
        $payload['title'] = $this->faker->word();
        $payload['content'] = '';

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_site_manage_notice_create_정확하지_않은_이미지_요청() {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin-site-manage.notice.image.integer'));

        $payload['category'] = Codes::select('code_id')->whereNotNull('code_id')->where('group_id', '220')->inRandomOrder()->first()->code_id;
        $payload['title'] = $this->faker->word();
        $payload['content'] = $this->faker->text(200);
        $payload['active'] = 'Y';
        $payload['image'] = ['asdasd'];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_site_manage_notice_create_존재하지_않은_이미지_요청() {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin-site-manage.notice.image.exists'));

        $payload['category'] = Codes::select('code_id')->whereNotNull('code_id')->where('group_id', '220')->inRandomOrder()->first()->code_id;
        $payload['title'] = $this->faker->word();
        $payload['content'] = $this->faker->text(200);
        $payload['active'] = 'Y';
        $payload['image'] = [0];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
    }

    // 정상 요청.
    public function test_admin_front_v1_site_manage_notice_create_정상_요청() {
        $images = array();

        $imageTask = MediaFileMasters::factory()->create([
            'media_name' => 'page-manage',
            'media_category' => 'notice',
            'dest_path' => '/storage/page-manage/notice/'.sha1(date("Ymd")),
            'file_name' => Helper::uuidSecure().'.jpeg',
            'original_name' => 'test.jpeg',
            'width' => 500,
            'height' => 500,
            'file_type' => 'image/jpeg',
            'file_size' => '106639',
            'file_extension' => 'jpeg',
        ]);
        $images[] = $imageTask->id;

        $imageTask = MediaFileMasters::factory()->create([
            'media_name' => 'page-manage',
            'media_category' => 'notice',
            'dest_path' => '/storage/page-manage/notice/'.sha1(date("Ymd")),
            'file_name' => Helper::uuidSecure().'.jpeg',
            'original_name' => 'test.jpeg',
            'width' => 500,
            'height' => 500,
            'file_type' => 'image/jpeg',
            'file_size' => '106639',
            'file_extension' => 'jpeg',
        ]);
        $images[] = $imageTask->id;

        $payload = [
            'category' => Codes::select('code_id')->whereNotNull('code_id')->where('group_id', '220')->inRandomOrder()->first()->code_id,
            'title' => $this->faker->word(),
            'content' => $this->faker->unique()->text(200),
            'image' => $images,
            'active' => 'Y'
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, $payload);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'result' => [
                'uuid',
            ]
        ]);
    }

    // 테스트 데이터 리셋.
    public function test_admin_front_v1_site_manage_notice_create_데이터_리셋()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        NoticeMasters::truncate();
        NoticeImages::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
