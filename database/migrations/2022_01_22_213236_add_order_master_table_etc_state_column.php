<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderMasterTableEtcStateColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_masters', function (Blueprint $table) {
            $table->char('delivery', 7)->after('state')->default('5200000')->comment('배송 상태.');
            $table->char('receive', 7)->after('delivery')->default('5300000')->comment('고객 상품 선택 상태.');


            $table->foreign('delivery')->references('code_id')->on('codes')->onDelete('cascade');
            $table->foreign('receive')->references('code_id')->on('codes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_masters', function($table) {

            $table->dropForeign('order_masters_delivery_foreign');
            $table->dropForeign('order_masters_receive_foreign');


            $table->dropColumn('delivery');
            $table->dropColumn('receive');
        });
    }
}
