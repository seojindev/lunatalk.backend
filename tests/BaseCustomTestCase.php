<?php

namespace Tests;

use App\Models\PhoneVerifies;
use App\Models\User;
use Crypt;
use DB;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Helper;

class BaseCustomTestCase extends TestCase
{
    use WithFaker;

    protected array $testUser;

    /**
     * Request Header.
     * @return string[]
     */
    public static function getTestDefaultApiHeaders() : array
    {
        return [
            'Request-Client-Type' => config('extract.default.front_code'),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * 관리자 테스트용 토큰 포함 해더.
     * @return string[]
     */
    protected function getTestAdminAccessTokenHeader() : array
    {
        $response = $this->withHeaders($this->getTestDefaultApiHeaders())->postjson('/api/v1/admin/auth/login', [
            "login_id" => \App\Models\User::where('user_level', 'S020900')->orderBy('id', 'ASC')->first()->login_id,
            "login_password" => 'password'
        ]);
        return [
            'Request-Client-Type' => config('extract.default.front_code'),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$response['result']['access_token']
        ];
    }

    /**
     * 일반 로그인 사용자 테스트용 헤더.
     * @return string[]
     */
    protected function getTestNormalAccessTokenHeader() : array
    {
        $response = $this->withHeaders($this->getTestDefaultApiHeaders())->postjson('/api/v1/service/auth/login', [
            "login_id" => \App\Models\User::where('user_level', 'S020010')->orderBy('id', 'ASC')->first()->login_id,
            "login_password" => 'password'
        ]);
        return [
            'Request-Client-Type' => config('extract.default.front_code'),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$response['result']['access_token']
        ];
    }

    protected function insertTestUser() : array
    {
        $testUser = [
            'login_id' => 'id'.uniqid(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'phone_number' => '01012340978',
        ];


        $us = User::factory()->create([
            'login_id' => $testUser['login_id'],
            'name' => $testUser['name'],
            'email' => $testUser['email'],
            'email_verified_at' => now(),
            'password' => $testUser['password'],
            'remember_token' => Str::random(10),
        ]);

        $pv = PhoneVerifies::factory()->create([
            'user_id' => $us->id,
            'phone_number' => Crypt::encryptString($testUser['phone_number']),
            'auth_code' => Helper::generateAuthNumberCode(),
            'verified' => 'Y',
        ]);

        $this->testUser = [
            'login_id' => $testUser['login_id'],
            'name' => $testUser['name'],
            'email' => $testUser['email'],
            'password' => $testUser['password'],
            'phone_number' => $testUser['phone_number'],
            'id' => $us->id,
            'pv_id' => $pv->id,
        ];

        return $this->testUser;
    }

    protected function deleteTestUser() : void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $users = User::select()->where('login_id', '<>', 'admin')->get()->toArray();
        foreach ($users as $user):
            PhoneVerifies::where('user_id', $user['id'])->forcedelete();
            User::where('id', $user['id'])->forcedelete();
        endforeach;

        PhoneVerifies::where('user_id', NULL)->forcedelete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
