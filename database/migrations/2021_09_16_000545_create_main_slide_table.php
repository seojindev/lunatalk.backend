<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainSlideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_slide_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_slide_id')->nullable(false)->comment('메인 슬라이드 id');
            $table->string('main_slide_name')->comment('메인 슬라이드 이름');
            $table->unsignedBigInteger('media_id')->nullable()->comment('메인 슬라이드 이미지');
            $table->enum('active',['Y','N'])->default('Y')->comment('상태');

            $table->timestamps();

            $table->softDeletes();

            $table->index('media_id');

            $table->foreign('media_id')->references('id')->on('media_file_masters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_slide_images');
    }
}
