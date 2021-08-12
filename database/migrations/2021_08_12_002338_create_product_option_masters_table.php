<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOptionMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_option_masters', function (Blueprint $table) {
            $table->id();
            $table->uuid('product_uuid')->nullable(false)->comment('상품 uuid');
            $table->unsignedBigInteger('color')->nullable(false)->comment('상품 색.');
            $table->unsignedBigInteger('wired')->nullable()->comment('유무선.');
            $table->enum('active' , ['Y', 'N'])->nullable(false)->default('Y')->comment('상태');
            $table->timestamps();

            $table->softDeletes();

            $table->index(['product_uuid', 'color']);

            $table->foreign('product_uuid')->references('uuid')->on('product_masters')->onDelete('cascade');
            $table->foreign('color')->references('id')->on('product_color_options')->onDelete('cascade');
            $table->foreign('wired')->references('id')->on('product_wired_options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_option_masters');
    }
}
