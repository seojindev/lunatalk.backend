<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderMasterTableNoticeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_masters', function (Blueprint $table) {
            $table->enum('notice',['Y','N'])->after('memo')->default('N')->comment('주문 알림.');
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
            $table->dropColumn('notice');
        });
    }
}
