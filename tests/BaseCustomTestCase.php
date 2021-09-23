<?php

namespace Tests;

use App\Models\MediaFileMasters;
use App\Models\PhoneVerifies;
use App\Models\ProductColorOptionMasters;
use App\Models\ProductImages;
use App\Models\ProductMasters;
use App\Models\ProductOptions;
use App\Models\ProductWirelessOptionMasters;
use App\Models\User;
use App\Models\UserRegisterSelects;
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
        $response = $this->withHeaders($this->getTestDefaultApiHeaders())->postjson('/api/admin-front/v1/auth/login', [
            "login_id" => User::where('level', config('extract.user_level.admin.level_code'))->orderBy('id', 'ASC')->first()->login_id,
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
        $response = $this->withHeaders($this->getTestDefaultApiHeaders())->postjson('/api/front/v1/auth/login', [
            "login_id" => User::where('level', config('extract.user_level.normal.level_code'))->orderBy('id', 'ASC')->first()->login_id,
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
        $user = User::select()->where('login_id', 'admin')->get()->first();

        PhoneVerifies::where('user_id', '<>', $user['id'])->forcedelete();
        UserRegisterSelects::where('user_id', '<>', $user['id'])->forcedelete();
        User::where('id', '<>', $user['id'])->forcedelete();

        PhoneVerifies::where('user_id', NULL)->forcedelete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    protected function insertTestRepImage() {
        return MediaFileMasters::factory()->create([
            'media_name' => 'products',
            'media_category' => 'rep',
            'dest_path' => '/storage/products/'.'/rep/'.sha1(date("Ymd")),
            'file_name' => Helper::uuidSecure().'.jpeg',
            'original_name' => Helper::uuidSecure().'.jpeg',
            'width' => '500',
            'height' => '500',
            'file_type' => 'image/jpeg',
            'file_size' => '106639',
            'file_extension' => 'jpeg',
        ]);
    }

    protected function insertTestDetailImage() {
        return MediaFileMasters::factory()->create([
            'media_name' => 'products',
            'media_category' => 'detail',
            'dest_path' => '/storage/products/'.'/rep/'.sha1(date("Ymd")),
            'file_name' => Helper::uuidSecure().'.jpeg',
            'original_name' => Helper::uuidSecure().'.jpeg',
            'width' => '500',
            'height' => '500',
            'file_type' => 'image/jpeg',
            'file_size' => '106639',
            'file_extension' => 'jpeg',
        ]);
    }

    protected function deleteTestRepImage(Int $modelId)
    {
        return MediaFileMasters::where('id', $modelId)->forceDelete();
    }

    protected function deleteTestDetailImage(Int $modelId)
    {
        return MediaFileMasters::where('id', $modelId)->forceDelete();
    }

    protected function insertTestProductMaster()
    {
        $repImage = $this->insertTestRepImage();
        $detailImage = $this->insertTestDetailImage();

        $productData = ProductMasters::factory()->create([
            "name" => "테스트 상품",
            "category" => 1,
            "barcode" => 123123123,
            "price" => 3000,
            "quantity" => 20,
            "memo" => "테스트 메모 입니다.",
            "sale" => "Y",
            "active" => "Y",
        ]);

        ProductOptions::factory()->create([
            'product_id' => $productData->id,
            'color' => ProductColorOptionMasters::select('id')->inRandomOrder()->first()->id,
            'wireless' => ProductWirelessOptionMasters::select('id')->inRandomOrder()->first()->id,
        ]);

        ProductImages::factory()->create([
            'product_id' => $productData->id,
            'media_category' => config('extract.mediaCategory.repImage.code'),
            'media_id' => $repImage->id,
            'active' => 'Y'
        ]);

        ProductImages::factory()->create([
            'product_id' => $productData->id,
            'media_category' => config('extract.mediaCategory.detailImage.code'),
            'media_id' => $detailImage->id,
            'active' => 'Y'
        ]);

        return $productData;
    }
}
