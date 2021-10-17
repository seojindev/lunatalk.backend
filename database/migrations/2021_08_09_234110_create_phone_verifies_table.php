<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneVerifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_verifies', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable(false)->default('')->comment('uuid');
            $table->unsignedBigInteger('user_id')->nullable()->comment('회원 번호');
            $table->string('phone_number')->nullable(false)->comment('인증 전화 번호');
            $table->string('auth_code', 10)->nullable(false)->comment('인증 코드');
            $table->enum('verified', ['Y', 'N'])->nullable()->default('N')->comment('인증 상태');
            $table->timestamps();

            $table->softDeletes();

            $table->index(['uuid', 'user_id', 'phone_number']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phone_verifies');
    }
}
