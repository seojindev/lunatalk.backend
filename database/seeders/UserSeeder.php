<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(env('APP_ENV') == "testing") {
            DB::table('users')->insert([
                'user_uuid' => Str::uuid()->toString(),
                'user_type' => 'S010010',
                'user_level' => 'S029999',
                'user_state' => 'S030100',
                'login_id' => 'test1',
                'nickname' => '최고 관리자',
                'email' => 'test1@lunatalk.co.kr',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'phone_number' => '010-1234-1234',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::table('users')->insert([
                'user_uuid' => Str::uuid()->toString(),
                'user_type' => 'S010010',
                'user_level' => 'S020900',
                'user_state' => 'S030100',
                'login_id' => 'test2',
                'nickname' => '관리자',
                'email' => 'test2@lunatalk.co.kr',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'phone_number' => '010-0234-0234',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::table('users')->insert([
                'user_uuid' => Str::uuid()->toString(),
                'user_type' => 'S010010',
                'user_level' => 'S020010',
                'user_state' => 'S030100',
                'login_id' => 'test3',
                'nickname' => '일반 사용자',
                'email' => 'test3@lunatalk.co.kr',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'phone_number' => '010-0234-0235',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
