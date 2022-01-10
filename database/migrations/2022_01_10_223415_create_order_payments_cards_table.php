<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments_cards', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pay_id')->nullable()->comment('페이 번호');

            $table->string('company')->nullable(false);
            $table->string('number')->nullable(false);
            $table->string('installmentPlanMonths')->nullable(false);
            $table->string('isInterestFree')->nullable(false);
            $table->string('approveNo')->nullable(false);
            $table->string('useCardPoint')->nullable(false);
            $table->string('cardType')->nullable(false);
            $table->string('ownerType')->nullable(false);
            $table->string('acquireStatus')->nullable(false);
            $table->string('receiptUrl')->nullable(false);

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
        Schema::dropIfExists('order_payments_cards');
    }
}
