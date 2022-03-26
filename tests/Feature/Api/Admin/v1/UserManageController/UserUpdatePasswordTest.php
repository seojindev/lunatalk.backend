<?php

namespace Tests\Feature\Api\Admin\v1\UserManageController;

use App\Models\User;
use Tests\BaseCustomTestCase;

class UserUpdatePasswordTest extends BaseCustomTestCase
{
    public function test_admin_front_v1_user_manage_update_user() {

        $task = User::inRandomOrder()->get()->first();

        $payload = [
            "user_password" => "121213123123",
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', "/api/admin-front/v1/user-manage/".$task->uuid."/update-user-password", $payload);
        $response->assertStatus(200);
//        $response->dump();
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
