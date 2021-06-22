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
        if (env('APP_ENV') != 'testing') {
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

        if (env('APP_ENV') != 'testing') {
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
            [ 'group_id' => 'S01', 'group_name' => '클라이언트 타입' ],
            [ 'group_id' => 'S02', 'group_name' => '사용자 레벨' ],
            [ 'group_id' => 'S03', 'group_name' => '사용자 상태' ],
            [ 'group_id' => 'S04', 'group_name' => '상태' ],
            [ 'group_id' => 'G01', 'group_name' => '메디아 파일 카테고리' ],
            [ 'group_id' => 'P01', 'group_name' => '상품 카테고리' ],
            [ 'group_id' => 'O10', 'group_name' => '상품 옵션1(색)' ],
            [ 'group_id' => 'O20', 'group_name' => '상품 옵션2' ],
            [ 'group_id' => 'E01', 'group_name' => '상품 옵션2' ],
        ];
    }

    /**
     * 코드 리스트
     * @return array
     */
    public function initCodesList(): array
    {
        return [
            'S01' => [
                [ 'code_id' => '0010', 'code_name' => 'Front' ],
                [ 'code_id' => '0020', 'code_name' => 'iOS' ],
                [ 'code_id' => '0030', 'code_name' => 'Android' ],
                [ 'code_id' => '0040', 'code_name' => 'Service - Front' ],
            ],
            'S02' => [
                [ 'code_id' => '0000', 'code_name' => 'Guest' ],
                [ 'code_id' => '0010', 'code_name' => '일반 사용자' ],
                [ 'code_id' => '0900', 'code_name' => '관리자' ],
                [ 'code_id' => '9999', 'code_name' => '최고 관리자' ],
            ],
            'S03' => [
                [ 'code_id' => '0000', 'code_name' => '차단' ],
                [ 'code_id' => '0010', 'code_name' => '제한' ],
                [ 'code_id' => '0011', 'code_name' => '대기' ],
                [ 'code_id' => '0100', 'code_name' => '정상' ],
            ],
            'S04' => [
                [ 'code_id' => '0000', 'code_name' => '비사용' ],
                [ 'code_id' => '0010', 'code_name' => '사용' ],
            ],
            'P01' => [
                [ 'code_id' => '0110', 'code_name' => 'acc' ],
                [ 'code_id' => '0120', 'code_name' => 'bag' ],
                [ 'code_id' => '0130', 'code_name' => 'stationery' ],
                [ 'code_id' => '0140', 'code_name' => 'wallet' ],
            ],
            'G01' => [
                [ 'code_id' => '0010', 'code_name' => '상품 이미지' ],
                [ 'code_id' => '0020', 'code_name' => '상품 상세 이미지' ],
                [ 'code_id' => '0030', 'code_name' => '상품 썸네일 이미지' ],
            ],
            'E01' => [
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
            'O10' => [
                [ 'code_id' => '0010', 'code_name' => '초콜릿' ],
                [ 'code_id' => '0020', 'code_name' => '레드' ],
                [ 'code_id' => '0030', 'code_name' => '네이비' ],
                [ 'code_id' => '0040', 'code_name' => '베리밀크' ],
                [ 'code_id' => '0050', 'code_name' => '화이트' ],
                [ 'code_id' => '0060', 'code_name' => '엔티크' ],
                [ 'code_id' => '0070', 'code_name' => '카키' ],
                [ 'code_id' => '0080', 'code_name' => '베이지' ],
                [ 'code_id' => '0090', 'code_name' => '핫핑크' ],
                [ 'code_id' => '0100', 'code_name' => '오렌지브라운' ],
                [ 'code_id' => '0110', 'code_name' => '올리브그린' ],
                [ 'code_id' => '0120', 'code_name' => '카멜베이지' ],
                [ 'code_id' => '0130', 'code_name' => '포레스트크린' ],
                [ 'code_id' => '0140', 'code_name' => '블랙' ],
                [ 'code_id' => '0150', 'code_name' => '스트로베리 레드' ],
                [ 'code_id' => '0160', 'code_name' => '머스타드옐로우' ],
                [ 'code_id' => '0170', 'code_name' => '스카이블루' ],
                [ 'code_id' => '0180', 'code_name' => '스트로베리레드' ],
                [ 'code_id' => '0190', 'code_name' => '카키브라운' ],
                [ 'code_id' => '0200', 'code_name' => '멜론그린' ],
                [ 'code_id' => '0210', 'code_name' => '크림슨레드' ],
                [ 'code_id' => '0220', 'code_name' => '아쿠아블루' ],
                [ 'code_id' => '0230', 'code_name' => '초코' ],
                [ 'code_id' => '0240', 'code_name' => '블루' ],
                [ 'code_id' => '0250', 'code_name' => '라일락' ],
                [ 'code_id' => '0260', 'code_name' => '카멜' ],
                [ 'code_id' => '0270', 'code_name' => '다크초콜릿' ],
                [ 'code_id' => '0280', 'code_name' => '블루블랙' ],
                [ 'code_id' => '0290', 'code_name' => '브라운' ],
                [ 'code_id' => '0300', 'code_name' => '아이보리' ],
                [ 'code_id' => '0310', 'code_name' => '다크브라운' ],
                [ 'code_id' => '0320', 'code_name' => '와인' ],
                [ 'code_id' => '0330', 'code_name' => '핑크' ],
                [ 'code_id' => '0340', 'code_name' => '블랙에나멜' ],
                [ 'code_id' => '0350', 'code_name' => '아이보리에나멜' ],
                [ 'code_id' => '0360', 'code_name' => '레드에나멜' ],
                [ 'code_id' => '0370', 'code_name' => '그린' ],
                [ 'code_id' => '0380', 'code_name' => '퍼플' ],
                [ 'code_id' => '0390', 'code_name' => '민트' ],
                [ 'code_id' => '0400', 'code_name' => '펄옐로우' ],
                [ 'code_id' => '0410', 'code_name' => '라임' ],
                [ 'code_id' => '0420', 'code_name' => '허니옐로우' ],
                [ 'code_id' => '0430', 'code_name' => '머스터드옐로우' ],
                [ 'code_id' => '0440', 'code_name' => '체리레드' ],
                [ 'code_id' => '0450', 'code_name' => '허니카라멜' ],
                [ 'code_id' => '0460', 'code_name' => '초코쿠키' ],
                [ 'code_id' => '0470', 'code_name' => '세피아' ],
                [ 'code_id' => '0480', 'code_name' => '체리봉봉' ],
                [ 'code_id' => '0490', 'code_name' => '블루베리' ],
                [ 'code_id' => '0500', 'code_name' => '애플그린' ],
                [ 'code_id' => '0510', 'code_name' => '마린블루' ],
                [ 'code_id' => '0520', 'code_name' => '카라멜' ],
                [ 'code_id' => '0530', 'code_name' => '베이비핑크' ],
                [ 'code_id' => '0540', 'code_name' => '커피브라운' ],
                [ 'code_id' => '0550', 'code_name' => '바이올렛핑크' ],
                [ 'code_id' => '0560', 'code_name' => '라임옐로우' ],
            ],
            'O20' => [
                [ 'code_id' => '0010', 'code_name' => '무선' ],
                [ 'code_id' => '0020', 'code_name' => '유선' ],
                [ 'code_id' => '0030', 'code_name' => '스케쥴러' ],
                [ 'code_id' => '0040', 'code_name' => '무선' ],

            ]
        ];
    }
}
