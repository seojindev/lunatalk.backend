<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductReviewsTableColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('review_id')->after('user_id')->nullable()->comment('원본 id.');

            $table->foreign('review_id')->references('id')->on('product_reviews')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_reviews', function (Blueprint $table) {
            $table->dropColumn(['review_id']);
        });
    }
}
