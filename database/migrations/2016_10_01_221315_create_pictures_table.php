<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('picture', function (Blueprint $table) {
            $table->engine = 'InnoDB COMMENT="图片表"';
            $table->increments('id');
            $table->string('path')->default('')->comment('路径');
            $table->string('url')->default('')->comment('图片链接');
            $table->char('md5',32)->default('')->comment('文件md5');
            $table->char('sha1',40)->default('')->comment('文件 sha1编码');
            $table->timestamp('create_time')->nullable()->comment('创建时间');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('picture');
    }
}
