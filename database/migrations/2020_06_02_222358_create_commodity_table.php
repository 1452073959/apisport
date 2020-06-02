<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommodityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commodity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('');
            $table->decimal('price')->nullable()->comment('价格');
            $table->decimal('memerprice')->nullable()->comment('会员价');
            $table->string('img')->nullable()->comment('商品图片');
            $table->integer('repertory')->nullable()->comment('库存');
            $table->dateTime('starttime')->nullable();
            $table->dateTime('endtime')->nullable();
            $table->integer('status')->default('0')->nullable()->comment('状态1上架0下架');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commodity');
    }
}
