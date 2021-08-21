<?php

namespace Tests\Unit;

use App\Exceptions\ClientErrorException;
use App\Models\PhoneVerifies;
use App\Models\UserRegisterSelects;
use Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\BaseCustomTestCase;
use App\Models\User;
use Helper;

class BaseTest extends BaseCustomTestCase
{

    /**
     * 마이그레이션 시드 체크
     *
     * @return void
     */
    public function test_base_server_migrate()
    {
        $this->assertDatabaseHas('codes', [
            'code_id' => config('extract.default.front_code'),
        ]);
    }

    /**
     * 클라이언트 코드 없을때
     */
    public function test_base_server_exception_클라이언트_코드없을때()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('exception.ClientTypeError'));

        $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->json('GET', '/api/system/check-status')->assertStatus(412);
    }

    /**
     * front 클라이언트 코드 체크
     */
    public function test_base_server_exception_front_클라이언트()
    {
        $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Request-Client-Type' => config('extract.default.front_code'),
        ])->json('GET', '/api/system/check-status')->assertNoContent();
    }

    /**
     * ios 클라이언트 코드 체크
     */
    public function test_base_server_exception_ios_클라이언트()
    {
        $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Request-Client-Type' => config('extract.default.ios_code'),
        ])->json('GET', '/api/system/check-status')->assertNoContent();
    }

    /**
     * android 클라이언트 코드 체크
     */
    public function test_base_server_exception_android_클라이언트()
    {
        $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Request-Client-Type' => config('extract.default.android_code'),
        ])->json('GET', '/api/system/check-status')->assertNoContent();
    }

    /**
     * service admin 클라이언트 코드 체크
     */
    public function test_base_server_exception_service_front_클라이언트()
    {
        $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Request-Client-Type' => config('extract.default.service_front_code'),
        ])->json('GET', '/api/system/check-status')->assertNoContent();
    }

    /**
     * 테스트 관리자 아이디 등록 테스트.
     */
    public function test_base_server_admin_등록()
    {
        $admins = DB::table('users')
            ->select('id')
            ->whereIn(
                'level', [config('extract.user_level.admin.level_code'), config('extract.user_level.root.level_code')]
            )->get()->toArray();

        foreach ($admins as $admin):
            UserRegisterSelects::where('user_id' , $admin->id)->forcedelete();
            PhoneVerifies::where('user_id' , $admin->id)->forcedelete();
            User::where('id' , $admin->id)->forcedelete();
        endforeach;

        $auth_code = Helper::generateAuthNumberCode();
        $phone_number = Crypt::encryptString('01012341234');
        $password = Hash::make('password');
        $login_id = 'admin';
        $name = '관리자';
        $level = config('extract.user_level.admin.level_code');
        $email = 'admin@test.com';
        $now = now();
        $remember_token = Str::random(10);

        $admin = User::factory()->create([
            'login_id' => $login_id,
            'name' => $name,
            'level' => $level,
            'email' => $email,
            'email_verified_at' => $now,
            'password' => $password, // password
            'remember_token' => $remember_token,
        ]);

        PhoneVerifies::factory()->create([
            'user_id' => $admin->id,
            'phone_number' => $phone_number,
            'auth_code' => $auth_code,
            'verified' => 'Y'
        ]);

        UserRegisterSelects::factory()->create([
            'user_id' => $admin->id,
            'email' => 'Y',
            'message' => 'Y'
        ]);

        $this->assertDatabaseHas('user_register_selects', [
            'user_id' => $admin->id,
            'email' => 'Y',
            'message' => 'Y'
        ]);

        $this->assertDatabaseHas('phone_verifies', [
            'user_id' => $admin->id,
            'phone_number' => $phone_number,
            'auth_code' => $auth_code,
            'verified' => 'Y'
        ]);

        $this->assertDatabaseHas('users', [
            'login_id' => $login_id,
            'name' => $name,
            'level' => $level,
            'email' => $email,
            'email_verified_at' => $now,
            'password' => $password, // password
            'remember_token' => $remember_token,
        ]);
    }

    /**
     * 테스트 일반 아이디 등록 테스트.
     */
    public function test_base_server_일반사용자_등록()
    {
        $users = DB::table('users')
            ->select('id')
            ->where('level', config('extract.user_level.normal.level_code'))->get()->toArray();

        foreach ($users as $user):
            UserRegisterSelects::where('user_id' , $user->id)->forcedelete();
            PhoneVerifies::where('user_id' , $user->id)->forcedelete();
            User::where('id' , $user->id)->forcedelete();
        endforeach;

        $auth_code = Helper::generateAuthNumberCode();
        $phone_number = Crypt::encryptString('01012351235');
        $password = Hash::make('password');
        $login_id = 'testuser';
        $name = '일반사용자';
        $level = config('extract.user_level.normal.level_code');
        $email = 'testuser@test.com';
        $now = now();
        $remember_token = Str::random(10);

        $user = User::factory()->create([
            'login_id' => $login_id,
            'name' => $name,
            'level' => $level,
            'email' => $email,
            'email_verified_at' => $now,
            'password' => $password, // password
            'remember_token' => $remember_token,
        ]);

        PhoneVerifies::factory()->create([
            'user_id' => $user->id,
            'phone_number' => $phone_number,
            'auth_code' => $auth_code,
            'verified' => 'Y'
        ]);

        UserRegisterSelects::factory()->create([
            'user_id' => $user->id,
            'email' => 'Y',
            'message' => 'Y'
        ]);

        $this->assertDatabaseHas('user_register_selects', [
            'user_id' => $user->id,
            'email' => 'Y',
            'message' => 'Y'
        ]);

        $this->assertDatabaseHas('phone_verifies', [
            'user_id' => $user->id,
            'phone_number' => $phone_number,
            'auth_code' => $auth_code,
            'verified' => 'Y'
        ]);

        $this->assertDatabaseHas('users', [
            'login_id' => $login_id,
            'name' => $name,
            'level' => $level,
            'email' => $email,
            'email_verified_at' => $now,
            'password' => $password, // password
            'remember_token' => $remember_token,
        ]);
    }
}
