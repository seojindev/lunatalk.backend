<?php

namespace Database\Seeders;

use App\Models\PhoneVerifies;
use App\Models\User;
use App\Models\UserRegisterSelects;
use Helper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            'uuid' => Str::uuid(),
            'login_id' => $login_id,
            'name' => $name,
            'level' => $level,
            'email' => $email,
            'email_verified_at' => $now,
            'password' => $password, // password
            'remember_token' => $remember_token,
        ]);

        PhoneVerifies::factory()->create([
            'uuid' => Str::uuid(),
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
    }
}
