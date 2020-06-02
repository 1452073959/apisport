<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSRaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_race', function (Blueprint $table) {
            $table->increments('id');
            $table->string('projectname')->default('')->comment('//项目类型');
            $table->string('projectcate')->default('')->comment('//项目类型');
            $table->string('city')->default('')->comment('城市');
            $table->string('address')->default('')->comment('地址');
            $table->string('venue')->default('')->comment('//场馆');
            $table->string('troops')->default('')->comment('//队伍');
            $table->string('smallimg')->default('')->comment('//小图');
            $table->string('bigimg')->default('')->comment('///大图');
            $table->dateTime('time')->comment('//时间');
            $table->tinyInteger('status')->default('0')->comment('//状态1开始2结束0未开始');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_race');
    }
}
