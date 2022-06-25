<?php

namespace Database\Seeders;

use App\Models\Codes;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(env('APP_ENV') !== 'testing') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Codes::truncate();
        }

        $arrayGroupCodesList = $this->initGroupCodesList();
        $arrayCodesList = $this->initCodesList();

        foreach ($arrayGroupCodesList as $element) :
            $group_id = trim($element['group_id']);
            $group_name = trim($element['group_name']);

            DB::table('codes')->insert([
                'group_id' => $group_id,
                'group_name' => $group_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            foreach ($arrayCodesList[$group_id] as $element_code):

                $code_id = trim($element_code['code_id']);
                $code_name = trim($element_code['code_name']);

                $endCodeid = $group_id . $code_id;

                DB::table('codes')->insert([
                    'group_id' => $group_id,
                    'group_name' => NULL,
                    'code_id' => $endCodeid,
                    'code_name' => $code_name,
                    'active' => 'Y',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

            endforeach;
        endforeach;

        if(env('APP_ENV') !== 'testing') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

    }
    /**
     * 그룹 코드 리스트
     * @return array
     */
    public function initGroupCodesList(): array
    {
        return [
            [ 'group_id' => '010', 'group_name' => '클라이언트.' ],
            [ 'group_id' => '110', 'group_name' => '사용자 타입.' ],
            [ 'group_id' => '120', 'group_name' => '사용자 레벨.' ],
            [ 'group_id' => '130', 'group_name' => '사용자 상태.' ],
            [ 'group_id' => '210', 'group_name' => '상태.' ],
            [ 'group_id' => '220', 'group_name' => '싸이트 공지 사항 카테고리.' ],
            [ 'group_id' => '230', 'group_name' => '메인 아이템 카테고리.' ],
            [ 'group_id' => '300', 'group_name' => '메디아 파일 카테고리.' ],
            [ 'group_id' => '400', 'group_name' => '이메일 리스트.' ],
            [ 'group_id' => '510', 'group_name' => '결제 상태.' ],
            [ 'group_id' => '520', 'group_name' => '배송상태.' ],
            [ 'group_id' => '530', 'group_name' => '취소/반품.' ],
            [ 'group_id' => '600', 'group_name' => '상품 카테고리 구분.' ],

        ];
    }

    /**
     * 코드 리스트
     * @return array
     */
    public function initCodesList(): array
    {
        return [
            '010' => [
                [ 'code_id' => '0010', 'code_name' => 'Front' ],
                [ 'code_id' => '0020', 'code_name' => 'iOS' ],
                [ 'code_id' => '0030', 'code_name' => 'Android' ],
                [ 'code_id' => '0040', 'code_name' => 'Front-Admin' ],
            ],
            '110' => [
                [ 'code_id' => '0010', 'code_name' => 'Lunatalk' ],
                [ 'code_id' => '0020', 'code_name' => 'Kakao' ],
                [ 'code_id' => '0030', 'code_name' => 'Naver' ],
            ],
            '120' => [
                [ 'code_id' => '0000', 'code_name' => 'Guest' ],
                [ 'code_id' => '0010', 'code_name' => '일반 사용자' ],
                [ 'code_id' => '0900', 'code_name' => '관리자' ],
                [ 'code_id' => '9999', 'code_name' => '최고 관리자' ],
            ],
            '130' => [
                [ 'code_id' => '0000', 'code_name' => '차단' ],
                [ 'code_id' => '0010', 'code_name' => '제한' ],
                [ 'code_id' => '0011', 'code_name' => '대기' ],
                [ 'code_id' => '0100', 'code_name' => '정상' ],
            ],
            '210' => [
                [ 'code_id' => '0000', 'code_name' => '비사용' ],
                [ 'code_id' => '0010', 'code_name' => '사용' ],
                [ 'code_id' => '0020', 'code_name' => '예' ],
                [ 'code_id' => '0030', 'code_name' => '아니요' ],
            ],
            '220' => [
                [ 'code_id' => '0000', 'code_name' => '일반' ],
                [ 'code_id' => '0010', 'code_name' => '긴급' ],
                [ 'code_id' => '0020', 'code_name' => '작업' ],
                [ 'code_id' => '0030', 'code_name' => '이벤트' ],
            ],
            '230' => [
                [ 'code_id' => '0000', 'code_name' => 'best item' ],
                [ 'code_id' => '0010', 'code_name' => 'new item' ],
            ],
            '300' => [
                [ 'code_id' => '0010', 'code_name' => '상품 이미지' ],
                [ 'code_id' => '0020', 'code_name' => '상품 썸네일 이미지' ],
                [ 'code_id' => '0030', 'code_name' => '상품 상세 이미지' ],

            ],
            '400' => [
                [ 'code_id' => '0010', 'code_name' => 'naver.com' ],
                [ 'code_id' => '0020', 'code_name' => 'hanmail.net' ],
                [ 'code_id' => '0030', 'code_name' => 'daum.net' ],
                [ 'code_id' => '0040', 'code_name' => 'nate.com' ],
                [ 'code_id' => '0050', 'code_name' => 'gmail.com' ],
                [ 'code_id' => '0060', 'code_name' => 'hotmail.com' ],
                [ 'code_id' => '0070', 'code_name' => 'lycos.co.kr' ],
                [ 'code_id' => '0080', 'code_name' => 'empal.com' ],
                [ 'code_id' => '0090', 'code_name' => 'cyworld.com' ],
                [ 'code_id' => '0100', 'code_name' => 'yahoo.com' ],
                [ 'code_id' => '0110', 'code_name' => 'paran.com' ],
                [ 'code_id' => '0120', 'code_name' => 'dreamwiz.com' ],
            ],
            '510' => [
                [ 'code_id' => '0000', 'code_name' => '결제 실패' ],
                [ 'code_id' => '0010', 'code_name' => '시도' ],
                [ 'code_id' => '0020', 'code_name' => '입금전' ],
                [ 'code_id' => '0030', 'code_name' => '결제완료' ],
                [ 'code_id' => '0040', 'code_name' => '입금완료' ],
            ],
            '520' => [
                [ 'code_id' => '0000', 'code_name' => '배송 준비중' ],
                [ 'code_id' => '0010', 'code_name' => '배송중' ],
                [ 'code_id' => '0020', 'code_name' => '배송완료' ],
            ],
            '530' => [
                [ 'code_id' => '0000', 'code_name' => '정상' ],
                [ 'code_id' => '0010', 'code_name' => '취소' ],
                [ 'code_id' => '0020', 'code_name' => '반품' ],
            ],
            '600' => [
                [ 'code_id' => '0010', 'code_name' => '이름순' ],
                [ 'code_id' => '0020', 'code_name' => '최신순' ],
                [ 'code_id' => '0030', 'code_name' => '가격낮은순' ],
                [ 'code_id' => '0040', 'code_name' => '가격높은순' ],
            ],
        ];
    }
}
