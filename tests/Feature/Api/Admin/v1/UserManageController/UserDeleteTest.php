<?php

namespace Tests\Feature\Api\Admin\v1\UserManageController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class UserDeleteTest extends BaseCustomTestCase
{
    public function test_admin_front_v1_user_manage_delete_user() {

        $task = User::inRandomOrder()->get()->first();

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', "/api/admin-front/v1/user-manage/".$task->uuid."/delete-user");
        $response->assertStatus(200);
//        $response->dump();
        $response->assertJsonStructure([
            'message'
        ]);
    }
}
