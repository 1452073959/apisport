<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sport_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no')->nullable()->comment('订单流水号');
            $table->string('ordertitle')->nullable()->comment('订单名称');
            $table->integer('vid')->comment('球场id');
            $table->integer('uid')->comment('用户id');
            $table->dateTime('starttime')->nullable()->comment('开始时间');
            $table->dateTime('endtime')->nullable()->comment('结束时间');
            $table->decimal('money')->nullable()->comment('金额');
            $table->dateTime('paid_at')->nullable()->comment('支付时间');
            $table->string('payment_no')->nullable()->comment('//微信订单号');
            $table->string('status')->nullable()->comment('订单状态');
            $table->text('invoice')->nullable()->comment('发票');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sport_order');
    }
}
