<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsVirtualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments_virtuals', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pay_id')->nullable()->comment('페이 번호');

            $table->string('accountNumber')->nullable(false);
            $table->string('accountType')->nullable(false);
            $table->string('bank')->nullable(false);
            $table->string('customerName')->nullable(false);
            $table->string('dueDate')->nullable(false);
            $table->string('expired')->nullable(false);
            $table->string('settlementStatus')->nullable(false);
            $table->string('refundStatus')->nullable(false);

            $table->timestamps();

            $table->foreign('pay_id')->references('id')->on('order_payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_payments_virtuals');
    }
}
