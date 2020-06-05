<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommodityOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commodity_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no')->nullable()->comment('订单流水号');
            $table->string('ordertitle')->nullable()->comment('订单名称');
            $table->integer('uid')->comment('用户id');
            $table->decimal('money')->nullable()->comment('金额');
            $table->dateTime('paid_at')->nullable()->comment('支付时间');
            $table->string('payment_no')->nullable()->comment('微信订单号');
            $table->string('status')->nullable()->comment('订单状态');
            $table->text('invoice')->nullable()->comment('发票');
            $table->string('ship_status')->nullable()->comment('物流状态');
            $table->text('ship_data')->nullable()->comment('物流数据');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commodity_order');
    }
}
