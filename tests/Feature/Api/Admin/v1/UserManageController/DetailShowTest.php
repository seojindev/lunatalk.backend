<?php

namespace Tests\Feature\Api\Admin\v1\UserManageController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class DetailShowTest extends BaseCustomTestCase
{
    public function test_admin_front_v1_user_manage_detail_user() {

        $task = User::inRandomOrder()->get()->first();

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', "/api/admin-front/v1/user-manage/".$task->uuid."/detail-user");
        $response->assertStatus(200);
//        $response->dump();
        $response->assertJsonStructure([
            'message',
            'result' => [
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
        ]);
    }
}
