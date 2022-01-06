<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_masters', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique()->nullable(false)->default('')->comment('uuid');
            $table->unsignedBigInteger('user_id')->nullable()->comment('회원 번호');
            $table->string('name')->nullable(false)->comment('이름');
            $table->string('phone')->nullable(false)->comment('휴대폰 번호');
            $table->string('email')->nullable(false)->comment('이메일');
            $table->text('message')->nullable(false)->comment('배송 메시지');
            $table->enum('active',['Y','N'])->default('N')->comment('결제 상태');

            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('order_masters');
    }
}
