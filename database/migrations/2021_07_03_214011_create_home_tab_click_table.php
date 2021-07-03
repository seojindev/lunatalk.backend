<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeTabClickTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_tab_click', function (Blueprint $table) {
            $table->id();
            $table->char('home_main_uid', 9)->nullable()->comment('홈 메인 uid.');
            $table->char('category_code', 7)->nullable()->comment('상품 카테고리 코드.');
            $table->char('remote_addr', 15)->nullable()->comment('IP.');
            $table->json('header')->default(new Expression('(JSON_ARRAY())'))->comment('request header.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_tab_click');
    }
}
