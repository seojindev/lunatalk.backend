<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable(false)->index()->comment('상품 고유값.');
            $table->string('media_category', 7)->nullable()->comment('이미지 카테고리.');
            $table->unsignedBigInteger('media_id')->nullable()->comment('제품 썸네일 이미지.');

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('media_category')->references('code_id')->on('codes')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('media_files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_images');
    }
}
