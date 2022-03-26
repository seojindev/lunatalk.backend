<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_items', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique()->nullable(false)->default('')->comment('uuid.');
            $table->string('category', 7)->nullable(false)->default('')->comment('구분.');
            $table->unsignedBigInteger('product_id')->nullable(false)->comment('상품 번호.');

            $table->timestamps();

            $table->softDeletes();

            $table->foreign('category')->references('code_id')->on('codes')->onDelete('cascade');
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
        Schema::dropIfExists('main_items');
    }
}
