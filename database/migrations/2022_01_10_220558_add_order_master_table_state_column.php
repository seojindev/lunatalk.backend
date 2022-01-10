<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderMasterTableStateColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_masters', function (Blueprint $table) {
            $table->enum('state',['Y','N'])->after('active')->default('N')->comment('결제 상태.');
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
            $table->dropColumn(['state']);
        });
    }
}
