<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_masters', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->default(DB::raw('(UUID())'))->comment('uuid');
            $table->uuid('category')->nullable(false)->comment('상품 카테고리.');
            $table->string('name')->nullable(false)->comment('상품명.');
            $table->string('barcode', 50)->nullable()->comment('상품 비코드.');
            $table->integer('price')->default(0)->comment('상품 가격.');
            $table->integer('stock')->default(0)->comment('상품 재고 수량.');
            $table->text('memo')->nullable()->comment('상품 메모.');
            $table->enum('sale', ['Y', 'N'])->default('N')->comment('상품 판매 유무.');
            $table->enum('active', ['Y', 'N'])->default('N')->comment('상품 상태.');
            $table->timestamps();

            $table->softDeletes();

            $table->index(['uuid', 'category', 'name']);

            $table->foreign('category')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_masters');
    }
}
