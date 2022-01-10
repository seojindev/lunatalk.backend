<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id')->nullable()->comment('오더 번호');

            $table->string('mId')->nullable(false)->default('');
            $table->string('version')->nullable(false)->default('');
            $table->string('transactionKey')->nullable(false)->default('');
            $table->string('paymentKey')->nullable(false)->default('');
            $table->string('orderId')->nullable(false)->default('');
            $table->string('orderName')->nullable(false)->default('');
            $table->string('method')->nullable(false)->default('');
            $table->string('status')->nullable(false)->default('');
            $table->string('requestedAt')->nullable(false)->default('');
            $table->string('approvedAt')->nullable(false)->default('');
            $table->string('useEscrow')->nullable(false)->default('');
            $table->string('cultureExpense')->nullable(false)->default('');

            $table->string('transfer')->nullable(false)->default('');
            $table->string('mobilePhone')->nullable(false)->default('');
            $table->string('giftCertificate')->nullable(false)->default('');
            $table->string('cashReceipt')->nullable(false)->default('');
            $table->string('discount')->nullable(false)->default('');
            $table->string('cancels')->nullable(false)->default('');
            $table->string('secret')->nullable(false)->default('');
            $table->string('type')->nullable(false)->default('');
            $table->string('easyPay')->nullable(false)->default('');
            $table->string('currency')->nullable(false)->default('');
            $table->string('totalAmount')->nullable(false)->default(0);
            $table->string('balanceAmount')->nullable(false)->default(0);
            $table->string('suppliedAmount')->nullable(false)->default(0);
            $table->string('vat')->nullable(false)->default(0);
            $table->string('taxFreeAmount')->nullable(false)->default(0);


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
        Schema::dropIfExists('order_payments');
    }
}
