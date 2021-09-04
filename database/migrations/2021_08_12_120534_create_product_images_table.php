<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable(false)->comment('상품 id');
            $table->char('media_category', 7)->nullable()->comment('이미지 카테고리.');
            $table->unsignedBigInteger('media_id')->nullable()->comment('제품 썸네일 이미지.');
            $table->enum('active', ['Y', 'N'])->default('Y')->comment('상태.');

            $table->timestamps();

            $table->softDeletes();

            $table->index(['product_id', 'media_category', 'media_id']);

            $table->foreign('product_id')->references('id')->on('product_masters')->onDelete('cascade');
            $table->foreign('media_category')->references('code_id')->on('codes')->onDelete('cascade');
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
        Schema::dropIfExists('product_images');
    }
}
