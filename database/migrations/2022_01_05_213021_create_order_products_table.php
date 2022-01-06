<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id')->nullable()->comment('오더 번호');
            $table->unsignedBigInteger('product_id')->nullable()->comment('오더 번호');

            $table->integer('price')->default(0)->comment('상품 가격.');

            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('order_masters')->onDelete('cascade');
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
        Schema::dropIfExists('order_products');
    }
}
