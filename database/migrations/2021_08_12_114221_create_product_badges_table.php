<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_badges', function (Blueprint $table) {
            $table->id();
            $table->uuid('product_uuid')->nullable(false)->comment('상품 uuid');
            $table->unsignedBigInteger('badge_id')->nullable(false)->comment('뱃지 아이디.');
            $table->enum('active' , ['Y', 'N'])->nullable(false)->default('Y')->comment('상태');
            $table->timestamps();

            $table->softDeletes();

            $table->foreign('product_uuid')->references('uuid')->on('product_masters')->onDelete('cascade');
            $table->foreign('badge_id')->references('id')->on('product_badge_masters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_badges');
    }
}
