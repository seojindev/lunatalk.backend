<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderMasterTableOrderNameOrderPriceColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_masters', function (Blueprint $table) {
            $table->string('order_name')->after('message')->nullable(false)->comment('상품명.');
            $table->integer('order_price')->after('order_name')->nullable(false)->comment('상품 가격.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_masters', function (Blueprint $table) {
            $table->dropColumn(['order_name', 'order_price']);
        });
    }
}
