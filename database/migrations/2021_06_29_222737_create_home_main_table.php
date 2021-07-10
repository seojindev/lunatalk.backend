<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_mains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable(false)->index()->comment('상품 고유값.');
            $table->unsignedBigInteger('media_id')->nullable()->comment('이미지 아이디.');
            $table->enum('status', ['Y', 'N'])->default('N')->comment('상태.');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('home_mains');
    }
}
