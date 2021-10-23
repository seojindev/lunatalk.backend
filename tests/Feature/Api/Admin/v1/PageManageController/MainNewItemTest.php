<?php

namespace Tests\Feature\Api\Admin\v1\PageManageController;

use App\Models\MainItem;
use App\Models\MediaFileMasters;
use App\Models\ProductMasters;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\BaseCustomTestCase;

class MainNewItemTest extends BaseCustomTestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_admin_front_v1_page_manage_main_new_item_create()
    {
        $product = ProductMasters::latest()->get()->first()->toArray();
        $media = MediaFileMasters::latest()->get()->first()->toArray();

        $uuid = $product['uuid'];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', "/api/admin-front/v1/page-manage/${uuid}/create-new-item");
        $response->assertStatus(201);
//        $response->dump();
        $response->assertJsonStructure([
            'message',
            'result' => [
                'uuid'
            ]
        ]);
    }

    public function test_admin_front_v1_page_manage_main_new_item_delete()
    {
        $product = ProductMasters::latest()->get()->first()->toArray();
        $media = MediaFileMasters::latest()->get()->first()->toArray();

        $productid = $product['id'];

        $uuid = Str::uuid();

        $createTask = MainItem::create([
            'uuid' => $uuid,
            'category' => config('extract.main_item.newItem.code'),
            'product_id' => $productid
        ]);



        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', "/api/admin-front/v1/page-manage/${uuid}/delete-new-item");
        $response->assertStatus(200);
//        $response->dump();
        $response->assertJsonStructure([
            'message',
        ]);
    }
//
    public function test_admin_front_v1_page_manage_main_new_item_list()
    {
        MainItem::factory([
            'category' => config('extract.main_item.newItem.code')
        ])->count(10)->create();

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', "/api/admin-front/v1/page-manage/show-new-item");
        $response->assertStatus(200);
//        $response->dump();
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
