<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('昵称');
            $table->string('avatarurl')->default('')->comment('头像');
            $table->string('openid')->default('')->comment('微信id');
            $table->tinyInteger('membership')->default('0')->nullable()->comment('是否会员0不是1是');
            $table->timestamp('end_time')->nullable()->comment('会员结束时间');
            $table->string('email')->nullable()->comment('邮箱');
            $table->timestamp('email_verified_at')->nullable()->comment('邮箱验证时间');
            $table->string('password')->nullable()->comment('密码');
            $table->string('remember_token')->nullable()->comment('//token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
