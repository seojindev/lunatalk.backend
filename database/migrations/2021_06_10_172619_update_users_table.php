<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_uuid', 50)->after('id')->unique()->default('')->comment('회원 uuid');
            $table->string('user_type', 7)->after('user_uuid')->default(config('extract.clientType.front.code'))->comment('회원 타입');
            $table->string('user_level', 7)->after('user_type')->default(config('extract.user.user_level.user.level_code'))->comment('회원 레벨');
            $table->enum('active', ['Y', 'N'])->after('remember_token')->default('Y')->comment('회원 상태');
            $table->string('nickname', 50)->after('name')->default('')->comment('회원 닉네임');

            $table->foreign('user_type')->references('code_id')->on('codes')->onDelete('cascade');
            $table->foreign('user_level')->references('code_id')->on('codes')->onDelete('cascade');
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
            if(DB::getDriverName() !== 'sqlite') $table->dropForeign('users_user_level_foreign');
            if(DB::getDriverName() !== 'sqlite') $table->dropForeign('users_user_type_foreign');
            if(DB::getDriverName() !== 'sqlite') $table->dropColumn(['user_uuid', 'user_type', 'user_level', 'active', 'nickname']);
        });
    }
}
