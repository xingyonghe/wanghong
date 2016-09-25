<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('user', function (Blueprint $table) {
            $table->engine = 'InnoDB COMMENT="用户基本信息"';
            $table->increments('id');
            $table->string('username')->comment('用户名');
            $table->string('email',150)->unique()->comment('邮箱');
            $table->string('mobile',100)->unique()->comment('手机号');
            $table->string('password')->comment('密码');
            $table->rememberToken()->comment('用户名');
            $table->timestamp('reg_time')->nullable()->comment('注册时间');
            $table->char('reg_ip',15)->comment('注册ID');
            $table->timestamp('login_time')->nullable()->comment('最后登录时间');
            $table->char('login_ip',15)->comment('最后登录ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('user');
    }
}
