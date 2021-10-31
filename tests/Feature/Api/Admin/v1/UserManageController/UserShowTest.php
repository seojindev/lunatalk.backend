<?php

namespace Tests\Feature\Api\Admin\v1\UserManageController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class UserShowTest extends BaseCustomTestCase
{
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_admin_front_v1_user_manage_show_user() {

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', "/api/admin-front/v1/user-manage/show-user");
        $response->assertStatus(200);
//        $response->dump();
        $response->assertJsonStructure([
            'message',
            'result' => [
                '*' => [
                    "id",
                    "uuid",
                    "client" => [
                        "code_id",
                        "code_name"
                    ],
                    "type" => [
                        "code_id",
                        "code_name"
                    ],
                    "level" => [
                        "code_id",
                        "code_name"
                    ],
                        "status" => [
                        "code_id",
                        "code_name"
                    ],
                    "active",
                    "created_at",
                    "updated_at"
                ]
            ]
        ]);
    }
}
