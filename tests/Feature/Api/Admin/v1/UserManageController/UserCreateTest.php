<?php

namespace Tests\Feature\Api\Admin\v1\UserManageController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class UserCreateTest extends BaseCustomTestCase
{
    public function test_admin_front_v1_user_manage_create_user() {

        $task = User::inRandomOrder()->get()->first();

        $payload = [
            "type" => "0100020",
            "level" => "1200900",
            "status" => "1300100",
            "user_id" => "testuser12",
            "user_password" => "121212",
            "user_phone_number" => "01012341234",
            "user_name" => "test-user",
            "user_email" => "test@gmail.com",
            'user_status' => "1300011",
            "user_select_email" => "Y",
            "user_select_message" => "Y"
        ];


        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', "/api/admin-front/v1/user-manage/create-user", $payload);
        $response->assertStatus(201);
//        $response->dump();
        $response->assertJsonStructure([
            'message',
            'result' => [
                "uuid",
            ]
        ]);
    }
}
