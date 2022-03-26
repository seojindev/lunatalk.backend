<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainSlideMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_slide_masters', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable(false)->default('')->comment('uuid');
            $table->string('name')->comment('메인 슬라이드 이름');
            $table->unsignedBigInteger('media_id')->nullable(false)->comment('메인 슬라이드 이미지');
            $table->unsignedBigInteger('product_id')->nullable()->comment('상품 ID');
            $table->string('slide_url')->nullable()->default('')->comment('이동 url');
            $table->text('memo')->nullable()->default('')->comment('메모.');
            $table->enum('active',['Y','N'])->default('Y')->comment('사용 유무');

            $table->timestamps();

            $table->softDeletes();

            $table->index(['uuid','name']);

            $table->foreign('media_id')->references('id')->on('media_file_masters')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('product_masters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_slide_masters');
    }
}
