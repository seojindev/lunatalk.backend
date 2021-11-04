<?php

namespace Tests\Feature\Api\Admin\v1\UserManageController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
            "user_email" => "test@test.com",
            "user_select_email" => "Y",
            "user_select_message" => "N"
        ];

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', "/api/admin-front/v1/user-manage/".$task->uuid."/update-user", $payload);
        $response->assertStatus(200);
        $response->dump();
        $response->assertJsonStructure([
            'message',
            'result' => [
                "uuid",
            ]
        ]);
    }
}
