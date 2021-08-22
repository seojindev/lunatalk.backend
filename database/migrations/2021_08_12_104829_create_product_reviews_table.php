<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable()->comment('상품 uuid');
            $table->unsignedBigInteger('user_id')->nullable()->comment('회원 번호');
            $table->text('contents')->nullable(false)->comment('리뷰 내용.');
            $table->enum('active', ['Y', 'N'])->default('Y')->comment('상태');
            $table->timestamps();

            $table->softDeletes();

            $table->index(['product_id', 'user_id']);

            $table->foreign('product_id')->references('id')->on('product_masters')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_reviews');
    }
}
