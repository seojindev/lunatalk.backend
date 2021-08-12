<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBadgeMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_badge_masters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false)->comment('뱃지 이름');
            $table->unsignedBigInteger('media_id')->nullable()->comment('메디아 파일 아이디.');
            $table->enum('active', ['Y', 'N'])->default('Y')->comment('상태.');
            $table->timestamps();

            $table->softDeletes();
            $table->foreign('media_id')->references('id')->on('media_files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_badge_masters');
    }
}
