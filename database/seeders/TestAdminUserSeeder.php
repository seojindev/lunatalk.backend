<?php

namespace Database\Seeders;

use App\Models\PhoneVerifies;
use App\Models\User;
use App\Models\UserRegisterSelects;
use Helper;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class TestAdminUserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $admin = [
            'login_id' => 'admin',
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'phone_number' => '01012341234',
        ];


        $us = User::create([
            'uuid' => Str::uuid(),
            'login_id' => $admin['login_id'],
            'level' => config('extract.user_level.admin.level_code'),
            'name' => $admin['name'],
            'email' => $admin['email'],
            'email_verified_at' => now(),
            'password' => $admin['password'],
            'remember_token' => Str::random(10),
        ]);

        PhoneVerifies::create([
            'uuid' => Str::uuid(),
            'user_id' => $us->id,
            'phone_number' => Crypt::encryptString($admin['phone_number']),
            'auth_code' => Helper::generateAuthNumberCode(),
            'verified' => 'Y',
        ]);

        UserRegisterSelects::factory()->create([
            'user_id' => $us->id,
            'email' => 'Y',
            'message' => 'Y'
        ]);
    }
}
