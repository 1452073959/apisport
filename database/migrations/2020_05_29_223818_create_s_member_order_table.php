<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSMemberOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_member_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户');
            $table->integer('member_id')->comment('会员卡类型id');
            $table->decimal('open_money')->comment('开通价格');
            $table->timestamp('open_time')->nullable()->comment('开通时间');
            $table->timestamp('end_time')->nullable()->comment('结束时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_member_order');
    }
}
