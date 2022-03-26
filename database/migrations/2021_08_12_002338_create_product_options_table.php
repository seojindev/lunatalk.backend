<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable(false)->comment('상품 id');
            $table->unsignedBigInteger('color')->nullable()->comment('상품 색.');
            $table->unsignedBigInteger('wireless')->nullable()->comment('유무선.');
            $table->enum('active' , ['Y', 'N'])->nullable(false)->default('Y')->comment('상태');
            $table->timestamps();

            $table->softDeletes();

            $table->index(['product_id', 'color', 'wireless']);

            $table->foreign('product_id')->references('id')->on('product_masters')->onDelete('cascade');
            $table->foreign('color')->references('id')->on('product_color_option_masters')->onDelete('cascade');
            $table->foreign('wireless')->references('id')->on('product_wireless_option_masters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_options');
    }
}
