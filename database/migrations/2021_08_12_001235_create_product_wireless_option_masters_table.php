<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductWirelessOptionMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_wireless_option_masters', function (Blueprint $table) {
            $table->id();
            $table->enum('wireless', ['Y', 'N'])->default('N')->comment('유무선 유무.');
            $table->enum('active', ['Y', 'N'])->default('Y')->comment('상태.');
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_wireless_option_masters');
    }
}
