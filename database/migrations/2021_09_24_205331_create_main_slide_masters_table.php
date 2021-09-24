<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainSlideMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_slide_masters', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->default(DB::raw('(UUID())'))->comment('uuid');
            $table->string('name')->comment('메인 슬라이드 이름');
            $table->enum('active',['Y','N'])->default('Y')->comment('전체 상태');

            $table->timestamps();

            $table->softDeletes();

            $table->index(['uuid','name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_slide_masters');
    }
}
