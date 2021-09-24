<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_slides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('media_id')->nullable(false)->comment('메인 슬라이드 이미지');
            $table->unsignedBigInteger('main_slide_id')->nullable(false)->comment('메인 슬라이드 id');
            $table->string('link')->comment('이동 url');
            $table->enum('active', ['Y', 'N'])->default('Y')->comment('메인 슬라이드 이미지 개별 상태');
            $table->timestamps();

            $table->softDeletes();

            $table->foreign('media_id')->references('id')->on('media_file_masters')->onDelete('cascade');
            $table->foreign('main_slide_id')->references('id')->on('main_slide_masters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_slides');
    }
}
