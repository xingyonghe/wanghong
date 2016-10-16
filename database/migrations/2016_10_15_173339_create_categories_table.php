<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('category', function (Blueprint $table) {
            $table->engine = 'InnoDB COMMENT"分类"';
            $table->increments('id');
            $table->string('name')->default('')->comment('分类名称');
            $table->integer('pid')->default(0)->comment('上级分类ID');
            $table->string('model',30)->default('')->comment('模块分组');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('category');
    }
}
