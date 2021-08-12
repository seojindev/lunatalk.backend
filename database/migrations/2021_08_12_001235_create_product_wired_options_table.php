<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductWiredOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_wired_options', function (Blueprint $table) {
            $table->id();
            $table->enum('wired', ['Y', 'N'])->default('Y')->comment('유무선 유무.');
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
        Schema::dropIfExists('product_wired_options');
    }
}
