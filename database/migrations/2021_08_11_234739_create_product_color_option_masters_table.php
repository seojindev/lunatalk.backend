<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductColorOptionMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_color_option_masters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false)->comment('컬러명');
            $table->string('eng_name', 255)->nullable(false)->comment('컬러 영문 명');
            $table->enum('active', ['Y', 'N'])->default('Y')->comment('성태');
            $table->timestamps();

            $table->index(['name']);

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
        Schema::dropIfExists('product_color_option_masters');
    }
}
