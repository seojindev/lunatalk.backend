<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUserStateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_state', 7)->default(config('extract.user.user_state.waiting.code'))->after('user_level')->comment('회원 상태.');

            $table->foreign('user_state')->references('code_id')->on('codes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if(DB::getDriverName() !== 'sqlite') $table->dropForeign('users_user_state_foreign');
            if(DB::getDriverName() !== 'sqlite') $table->dropColumn(['user_state']);
        });
    }
}
