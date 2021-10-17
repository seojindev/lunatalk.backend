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
            $table->string('uuid', 50)->after('id')->unique()->nullable(false)->default('')->comment('회원 uuid');
            $table->char('client', 7)->after('uuid')->default(config('extract.default.user_client'))->comment('회원 타입');
            $table->char('type', 7)->after('client')->default(config('extract.default.user_type'))->comment('회원 타입');
            $table->char('level', 7)->after('type')->default(config('extract.default.user_level'))->comment('회원 레벨');
            $table->char('login_id', 50)->after('level')->unique()->nullable(false)->comment('로그인 아이디');
            $table->char('status', 7)->default(config('extract.default.user_status'))->after('remember_token')->comment('회원 상태.');
            $table->enum('active', ['Y', 'N'])->after('status')->default('Y')->comment('회원 상태');


            $table->foreign('type')->references('code_id')->on('codes')->onDelete('cascade');
            $table->foreign('level')->references('code_id')->on('codes')->onDelete('cascade');
            $table->foreign('status')->references('code_id')->on('codes')->onDelete('cascade');


            $table->index(['uuid', 'login_id']);
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
            $table->dropForeign('users_client_foreign');
            $table->dropForeign('users_type_foreign');
            $table->dropForeign('users_level_foreign');
            $table->dropForeign('users_status_foreign');

            $table->dropColumn(['uuid', 'client', 'type', 'level', 'login_id', 'status', 'active']);
        });
    }
}
