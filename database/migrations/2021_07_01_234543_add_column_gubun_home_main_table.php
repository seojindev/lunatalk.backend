<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnGubunHomeMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_mains', function (Blueprint $table) {
            $table->char('gubun', 7)->default('P100010')->after('id')->comment('구분.');

            $table->foreign('gubun')->references('code_id')->on('codes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_mains', function (Blueprint $table) {
            if(DB::getDriverName() !== 'sqlite') $table->dropForeign('home_mains_gubun_foreign');
            if(DB::getDriverName() !== 'sqlite') $table->dropColumn(['gubun']);
        });
    }
}
