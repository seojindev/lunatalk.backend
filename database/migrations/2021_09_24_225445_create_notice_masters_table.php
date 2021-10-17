<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticeMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_masters', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable(false)->default('')->comment('uuid');
            $table->char('category', 7)->default(config('extract.default.site_notice_code'))->comment('공지사항 카테고리.');
            $table->string('title')->nullable(false)->comment('제목.');
            $table->text('content')->nullable()->comment('내용.');
            $table->enum('active', ['Y', 'N'])->default('Y')->comment('상태');

            $table->timestamps();

            $table->softDeletes();

            $table->foreign('category')->references('code_id')->on('codes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_masters');
    }
}
