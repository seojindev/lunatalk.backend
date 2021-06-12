<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneAuthUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->unique()->default(NULL)->after('remember_token')->comment('회원 휴대폰 번호.');
            $table->enum('phone_verified', ['Y', 'N'])->after('phone_number')->default('N')->comment('회원 휴대폰 인증 상태.');
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
            if(DB::getDriverName() !== 'sqlite') $table->dropColumn(['phone_number']);
            if(DB::getDriverName() !== 'sqlite') $table->dropColumn(['phone_verified']);
        });
    }
}
