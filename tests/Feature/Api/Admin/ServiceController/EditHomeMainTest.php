<?php

namespace Tests\Feature\Api\Admin\ServiceController;

use App\Exceptions\ClientErrorException;
use App\Models\HomeMains;
use App\Models\MediaFiles;
use App\Models\Products;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;


class EditHomeMainTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_admin_edit_home_main_create_이미지_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.service.edit.home-main.image-required'));

        $testPayload = '{
            "edit_image" : "",
            "edit_product_select" : "",
            "edit_status" : ""
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/admin/service/edit-home-main', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_create_존재_하지_않은_이미지_선택_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.service.edit.home-main.image-exists'));

        $testPayload = '{
            "edit_image" : "10000000",
            "edit_product_select" : "",
            "edit_status" : ""
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/admin/service/edit-home-main', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_create_상품_선택_없이_요청()
    {
        $randImageTask = MediaFiles::select()->inRandomOrder()->first();
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.service.edit.home-main.product-required'));

        $testPayload = '{
            "edit_image" : "'.$randImageTask->id.'",
            "edit_product_select" : "",
            "edit_status" : ""
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/admin/service/edit-home-main', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_create_존재_하지_않은_상품_선택_요청()
    {
        $randImageTask = MediaFiles::select()->inRandomOrder()->first();
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.service.edit.home-main.product-exists'));

        $testPayload = '{
            "edit_image" : "'.$randImageTask->id.'",
            "edit_product_select" : "1111111111111",
            "edit_status" : ""
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/admin/service/edit-home-main', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_create_상태_값_없이_요청()
    {
        $randImageTask = MediaFiles::select()->inRandomOrder()->first();
        $randProduct = Products::select()->inRandomOrder()->first();

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.service.edit.home-main.status-required'));

        $testPayload = '{
            "edit_image" : "'.$randImageTask->id.'",
            "edit_product_select" : "'.$randProduct->uuid.'",
            "edit_status" : ""
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/admin/service/edit-home-main', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_create_정상_상태_값이_아닌_상태_요청()
    {
        $randImageTask = MediaFiles::select()->inRandomOrder()->first();
        $randProduct = Products::select()->inRandomOrder()->first();

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.service.edit.home-main.status-in'));

        $testPayload = '{
            "edit_image" : "'.$randImageTask->id.'",
            "edit_product_select" : "'.$randProduct->uuid.'",
            "edit_status" : "asdasdasd"
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/admin/service/edit-home-main', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_create_중복_상품_선택_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.service.edit.home-main.product-main-unique'));

        $randImageTask = MediaFiles::select()->inRandomOrder()->first();
        $selectHomeMain = HomeMains::with(['product'])->where('gubun', config('extract.homeMainGubun.mainTop.code'))->inRandomOrder()->first()->toArray();
        $product_uuid = $selectHomeMain['product']['uuid'];

        $testPayload = '{
            "edit_image" : "'.$randImageTask->id.'",
            "edit_product_select" : "'.$product_uuid.'",
            "edit_status" : "Y"
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/admin/service/edit-home-main', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_create_정상_요청()
    {
        $randImageTask = MediaFiles::select()->inRandomOrder()->first();
        $selectHomeMain = HomeMains::select('product_id')->where('gubun', config('extract.homeMainGubun.mainTop.code'))->get()->toArray();

        $tmpProductIds = [];
        foreach ($selectHomeMain as $element) :
            $tmpProductIds[] = $element['product_id'];
        endforeach;

        $randProduct = Products::select()->whereNotIn('id', $tmpProductIds)->inRandomOrder()->first();

        $testPayload = '{
            "edit_image" : "'.$randImageTask->id.'",
            "edit_product_select" : "'.$randProduct->uuid.'",
            "edit_status" : "Y"
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/admin/service/edit-home-main', json_decode($testPayload, true))
            ->assertStatus(201)
            ->assertJsonStructure([
                'message'
            ]);
    }

    // 업데이트 테스트.
    public function test_admin_edit_home_main_update_존재_하지않은_home_main_요청()
    {
        $this->expectException(ModelNotFoundException::class);

        $testPayload = '{
            "edit_image" : "",
            "edit_product_select" : "",
            "edit_status" : ""
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', '/api/v1/admin/service/12122/edit-home-main', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_update_이미지_없이_요청()
    {
        $selectHomeMain = HomeMains::select()->inRandomOrder()->first();
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.service.edit.home-main.image-required'));

        $testPayload = '{
            "edit_image" : "",
            "edit_product_select" : "",
            "edit_status" : ""
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', '/api/v1/admin/service/'.$selectHomeMain->id.'/edit-home-main', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_update_존재_하지_않은_이미지_선택_요청()
    {
        $selectHomeMain = HomeMains::select()->inRandomOrder()->first();
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.service.edit.home-main.image-exists'));

        $testPayload = '{
            "edit_image" : "10000000",
            "edit_product_select" : "",
            "edit_status" : ""
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', '/api/v1/admin/service/'.$selectHomeMain->id.'/edit-home-main', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_update_상품_선택_없이_요청()
    {
        $selectHomeMain = HomeMains::select()->inRandomOrder()->first();
        $randImageTask = MediaFiles::select()->inRandomOrder()->first();
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.service.edit.home-main.product-required'));

        $testPayload = '{
            "edit_image" : "'.$randImageTask->id.'",
            "edit_product_select" : "",
            "edit_status" : ""
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', '/api/v1/admin/service/'.$selectHomeMain->id.'/edit-home-main', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_update_존재_하지_않은_상품_선택_요청()
    {
        $selectHomeMain = HomeMains::select()->inRandomOrder()->first();
        $randImageTask = MediaFiles::select()->inRandomOrder()->first();
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.service.edit.home-main.product-exists'));

        $testPayload = '{
            "edit_image" : "'.$randImageTask->id.'",
            "edit_product_select" : "1111111111111",
            "edit_status" : ""
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', '/api/v1/admin/service/'.$selectHomeMain->id.'/edit-home-main', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_update_상태_값_없이_요청()
    {
        $selectHomeMain = HomeMains::select()->inRandomOrder()->first();
        $randImageTask = MediaFiles::select()->inRandomOrder()->first();
        $randProduct = Products::select()->inRandomOrder()->first();

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.service.edit.home-main.status-required'));

        $testPayload = '{
            "edit_image" : "'.$randImageTask->id.'",
            "edit_product_select" : "'.$randProduct->uuid.'",
            "edit_status" : ""
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', '/api/v1/admin/service/'.$selectHomeMain->id.'/edit-home-main', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_update_정상_상태_값이_아닌_상태_요청()
    {
        $selectHomeMain = HomeMains::select()->inRandomOrder()->first();
        $randImageTask = MediaFiles::select()->inRandomOrder()->first();
        $randProduct = Products::select()->inRandomOrder()->first();

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.service.edit.home-main.status-in'));

        $testPayload = '{
            "edit_image" : "'.$randImageTask->id.'",
            "edit_product_select" : "'.$randProduct->uuid.'",
            "edit_status" : "asdasdasd"
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', '/api/v1/admin/service/'.$selectHomeMain->id.'/edit-home-main', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_update_정상_요청()
    {
        $selectHomeMain = HomeMains::select()->inRandomOrder()->first();
        $randImageTask = MediaFiles::select()->inRandomOrder()->first();
        $randProduct = Products::select()->inRandomOrder()->first();

        $testPayload = '{
            "edit_image" : "'.$randImageTask->id.'",
            "edit_product_select" : "'.$randProduct->uuid.'",
            "edit_status" : "Y"
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('PUT', '/api/v1/admin/service/'.$selectHomeMain->id.'/edit-home-main', json_decode($testPayload, true))
            ->assertStatus(200)
            ->assertJsonStructure([
                'message'
            ]);
    }

    // 삭제 테스트
    public function test_admin_edit_home_main_delete_존재하지_않은_삭제_요청()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->withHeaders($this->getTestAccessTokenHeader())->json('DELETE', '/api/v1/admin/service/100/edit-home-main');
    }

    public function test_admin_edit_home_main_delete_정상_요청()
    {
        $selectHomeMain = HomeMains::select()->inRandomOrder()->first();
        $this->withHeaders($this->getTestAccessTokenHeader())->json('DELETE', '/api/v1/admin/service/'.$selectHomeMain->id.'/edit-home-main')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message'
            ]);
    }

    // 상태 업데이트.
    public function test_admin_edit_home_main_status_update_존재하지_않은_요청()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/admin/service/100/edit-home-main/status');
    }


    public function test_admin_edit_home_main_status_update_상태값_없이_요청()
    {
        $selectHomeMain = HomeMains::select()->where('status', 'N')->inRandomOrder()->first();

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('admin.service.edit.home-main.status-required'));

        $testPayload = '{
            "edit_status" : ""
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/admin/service/'.$selectHomeMain->id.'/edit-home-main/status', json_decode($testPayload, true));
    }

    public function test_admin_edit_home_main_status_update_정상_요청()
    {
        $selectHomeMain = HomeMains::select()->inRandomOrder()->first();

        $testPayload = '{
            "edit_status" : "Y"
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/admin/service/'.$selectHomeMain->id.'/edit-home-main/status', json_decode($testPayload, true))
            ->assertStatus(200)
            ->assertJsonStructure([
                'message'
            ]);
    }
}
