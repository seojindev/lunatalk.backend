<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUidHomeMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_mains', function (Blueprint $table) {
            $table->char('uid', 9)->nullable(false)->after('id')->comment('uid.');
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
            if(DB::getDriverName() !== 'sqlite') $table->dropColumn(['uid']);
        });
    }
}
