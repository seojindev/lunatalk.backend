<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_files', function (Blueprint $table) {
            $table->id();
            $table->string('media_name')->nullable(false)->comment('미디어명.');
            $table->string('media_category')->nullable(false)->comment('미디어 구분.');
            $table->string('dest_path')->nullable(false)->comment('저장 디렉토리 경로.');
            $table->string('file_name')->nullable(false)->comment('파일명.');
            $table->string('original_name')->nullable(false)->comment('원본 파일명.');
            $table->string('file_type', 50)->nullable(false)->comment('원본 파일 타입.');
            $table->bigInteger('file_size')->nullable(false)->comment('파일 용량.');
            $table->string('file_extension', 50)->nullable(false)->comment('파일 확장자.');
            $table->timestamps();

            $table->index(['media_name', 'media_category' , 'file_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_files');
    }
}
