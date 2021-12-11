<?php

namespace Tests\Feature\Api\Admin\v1\UserManageController;

use App\Models\User;
use Tests\BaseCustomTestCase;

class UserUpdateTest extends BaseCustomTestCase
{
    public function test_admin_front_v1_user_manage_update_user() {

        $task = User::inRandomOrder()->get()->first();

        $payload = [
            "type" => "0100020",
            "level" => "1200900",
            "status" => "1300100",
            "user_name" => "test-user",
            "user_email" => "test@gmail.com",
            "user_select_email" => "Y",
            "user_select_message" => "N",
            "user_memo" => "테스트 메모 입니다\n보이나요?"
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', "/api/admin-front/v1/user-manage/".$task->uuid."/update-user", $payload);
        $response->assertStatus(200);
//        $response->dump();
        $response->assertJsonStructure([
            'message',
            'result' => [
                "uuid",
            ]
        ]);
    }
}
