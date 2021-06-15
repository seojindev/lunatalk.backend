<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryColumnMediaFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_files', function (Blueprint $table) {
            $table->string('category', 7)->default(config('extract.mediaCategory.productImage.code'))->after('id')->comment('메디아 파일 카테고리.');

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
        //
    }
}
