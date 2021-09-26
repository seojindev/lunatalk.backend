<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticeImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notice_id')->nullable(false)->comment('공지사항 id');
            $table->unsignedBigInteger('media_id')->nullable()->comment('공지사항 이미지.');
            $table->enum('active', ['Y', 'N'])->default('Y')->comment('상태.');

            $table->timestamps();

            $table->softDeletes();

            $table->foreign('notice_id')->references('id')->on('notice_masters')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('media_file_masters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_images');
    }
}
