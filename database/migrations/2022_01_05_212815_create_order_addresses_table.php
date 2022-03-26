<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id')->nullable()->comment('오더 번호');
            $table->string('zipcode')->nullable(false)->comment('우편번호');
            $table->string('step1')->nullable(false)->comment('주소');
            $table->string('step2')->nullable(false)->comment('상세 주소');

            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('order_masters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_addresses');
    }
}
