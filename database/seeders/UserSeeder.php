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
                'user_type' => 'S01010',
                'user_level' => 'S02999',
                'user_state' => 'S03100',
                'login_name' => 'test1',
                'nickname' => '최고 관리자',
                'email' => 'test1@lunatalk.co.kr',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('1212'),
                'phone_number' => '010-1234-1234',
                'phone_verified' => 'Y',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::table('users')->insert([
                'user_uuid' => Str::uuid()->toString(),
                'user_type' => 'S01010',
                'user_level' => 'S02999',
                'user_state' => 'S03100',
                'login_name' => 'test2',
                'nickname' => '최고 관리자',
                'email' => 'test2@lunatalk.co.kr',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('1212'),
                'phone_number' => '010-0234-0234',
                'phone_verified' => 'Y',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
