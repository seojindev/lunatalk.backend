<?php

namespace Database\Seeders;

use App\Models\ProductColorOptions;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductColorOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colorItems = [
            '초콜릿',
            '레드',
            '네이비',
            '베리밀크',
            '화이트',
            '엔티크',
            '카키',
            '베이지',
            '핫핑크',
            '오렌지브라운',
            '올리브그린',
            '카멜베이지',
            '포레스트크린',
            '블랙',
            '스트로베리 레드',
            '머스타드옐로우',
            '스카이블루',
            '스트로베리레드',
            '카키브라운',
            '멜론그린',
            '크림슨레드',
            '아쿠아블루',
            '초코',
            '블루',
            '라일락',
            '카멜',
            '다크초콜릿',
            '블루블랙',
            '브라운',
            '아이보리',
            '다크브라운',
            '와인',
            '핑크',
            '블랙에나멜',
            '아이보리에나멜',
            '레드에나멜',
            '그린',
            '퍼플',
            '민트',
            '펄옐로우',
             '라임',
            '허니옐로우',
            '머스터드옐로우',
            '체리레드',
            '허니카라멜',
            '초코쿠키',
            '세피아',
            '체리봉봉',
            '블루베리',
            '애플그린',
            '마린블루',
            '카라멜',
            '베이비핑크',
            '커피브라운',
            '바이올렛핑크',
            '라임옐로우',
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductColorOptions::truncate();

        foreach ($colorItems as $item):
            DB::table('product_color_options')->insert([
                'name' => $item,
                'eng_name' => '',
                'active' => 'Y',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        endforeach;
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
