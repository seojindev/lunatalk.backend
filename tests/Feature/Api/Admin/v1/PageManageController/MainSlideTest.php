<?php

namespace Tests\Feature\Api\Admin\v1\PageManageController;

use App\Models\MainSlideMasters;
use App\Models\MediaFileMasters;
use App\Models\ProductMasters;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\BaseCustomTestCase;

class MainSlideTest extends BaseCustomTestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_admin_front_v1_page_manage_main_slade_create()
    {
        $product = ProductMasters::latest()->get()->first()->toArray();
        $media = MediaFileMasters::latest()->get()->first()->toArray();

        $payload = [
            "name" => $this->faker->word(),
            "active" => "Y",
            "media_id" => $media['id'],
            "link" => $this->faker->domainWord(),
            "product_id" => $product['id'],
            "memo" => "테스트 메모 입니다\n 보이나요?"
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', '/api/admin-front/v1/page-manage/create-main-slide', $payload);
        $response->assertStatus(201);
//        $response->dump();
        $response->assertJsonStructure([
            'message',
            'result' => [
                'uuid'
            ]
        ]);
    }

    public function test_admin_front_v1_page_manage_main_slide_update()
    {
        $product = ProductMasters::latest()->get()->first()->toArray();
        $media = MediaFileMasters::factory()->create()->toArray();

        $task = MainSlideMasters::create([
            'uuid' => Str::uuid(),
            'name' => $this->faker->word(),
            'media_id' => $media['id'],
            'product_id' => $product['id'],
            'link' => $this->faker->domainWord,
            'memo' => "test Memo....",
            'active' => 'Y',
        ]);


        $payload = [
            'name' => $this->faker->word(),
            'media_id' => $media['id'],
            'product_id' => $product['id'],
            'link' => $this->faker->domainWord,
            'memo' => "test Memo....",
            'active' => 'Y',
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', '/api/admin-front/v1/page-manage/'.$task->uuid.'/update-main-slide', $payload);
        $response->assertStatus(200);
//        $response->dump();
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_admin_front_v1_page_manage_main_slide_delete()
    {
        $product = ProductMasters::latest()->get()->first()->toArray();
        $media = MediaFileMasters::factory()->create()->toArray();

        $task1 = MainSlideMasters::create([
            'uuid' => Str::uuid(),
            'name' => $this->faker->word(),
            'media_id' => $media['id'],
            'product_id' => $product['id'],
            'link' => $this->faker->domainWord,
            'memo' => "test Memo....",
            'active' => 'Y',
        ]);

        $task2 = MainSlideMasters::create([
            'uuid' => Str::uuid(),
            'name' => $this->faker->word(),
            'media_id' => $media['id'],
            'product_id' => $product['id'],
            'link' => $this->faker->domainWord,
            'memo' => "test Memo....",
            'active' => 'Y',
        ]);

        $task3 = MainSlideMasters::create([
            'uuid' => Str::uuid(),
            'name' => $this->faker->word(),
            'media_id' => $media['id'],
            'product_id' => $product['id'],
            'link' => $this->faker->domainWord,
            'memo' => "test Memo....",
            'active' => 'Y',
        ]);


        $payload = [
            'uuid' => [
                $task1->uuid,
                $task2->uuid,
                $task3->uuid
            ]
        ];


        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', '/api/admin-front/v1/page-manage/delete-main-slides', $payload);
        $response->assertStatus(200);
//        $response->dump();
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_admin_front_v1_page_manage_main_slide_list() {
        $product = ProductMasters::latest()->get()->first()->toArray();
        $media = MediaFileMasters::factory()->create()->toArray();

        $task1 = MainSlideMasters::create([
            'uuid' => Str::uuid(),
            'name' => $this->faker->word(),
            'media_id' => $media['id'],
            'product_id' => $product['id'],
            'link' => $this->faker->domainWord,
            'memo' => "test Memo....",
            'active' => 'Y',
        ]);

        $task2 = MainSlideMasters::create([
            'uuid' => Str::uuid(),
            'name' => $this->faker->word(),
            'media_id' => $media['id'],
            'product_id' => $product['id'],
            'link' => $this->faker->domainWord,
            'memo' => "test Memo....",
            'active' => 'Y',
        ]);

        $task3 = MainSlideMasters::create([
            'uuid' => Str::uuid(),
            'name' => $this->faker->word(),
            'media_id' => $media['id'],
            'product_id' => $product['id'],
            'link' => $this->faker->domainWord,
            'memo' => "test Memo....",
            'active' => 'Y',
        ]);

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', '/api/admin-front/v1/page-manage/show-main-slide');
        $response->assertStatus(200);
//        $response->dump();
        $response->assertJsonStructure([
            'message',
            'result' => [
                '*' => [
                    'id',
                    'uuid',
                    'name',
                    'active'
                ]
            ]
        ]);
    }

    public function test_admin_front_v1_page_manage_main_slide_detail() {
        $product = ProductMasters::latest()->get()->first()->toArray();
        $media = MediaFileMasters::factory()->create()->toArray();

        $task = MainSlideMasters::create([
            'uuid' => Str::uuid(),
            'name' => $this->faker->word(),
            'media_id' => $media['id'],
            'product_id' => $product['id'],
            'link' => $this->faker->domainWord,
            'memo' => "test Memo....",
            'active' => 'Y',
        ]);

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', '/api/admin-front/v1/page-manage/'.$task->uuid.'/detail-main-slide');
        $response->assertStatus(200);
//        $response->dump();
        $response->assertJsonStructure([
            'message',
            'result' => [
                'uuid',
                'name',
                'active',
                'image' => [
                    'id',
                    'file_name',
                    'url'
                ],
            ]
        ]);
    }
}
