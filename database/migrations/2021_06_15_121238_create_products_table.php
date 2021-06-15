<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 50)->unique()->nullable(false)->comment('상품 uuid.');
            $table->string('category', 7)->nullable(false)->comment('상품 카테고리.');
            $table->string('name')->nullable(false)->comment('상품명.');
            $table->string('barcode', 50)->nullable()->comment('상품 비코드.');
            $table->integer('price')->default(0)->comment('상품 가격.');
            $table->integer('stock')->default(0)->comment('상품 재고 수량.');
            $table->enum('sale', ['Y', 'N'])->default('N')->comment('상품 판매 유무.');
            $table->enum('active', ['Y', 'N'])->default('N')->comment('상품 상태.');
            $table->timestamps();

            $table->foreign('category')->references('code_id')->on('codes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
