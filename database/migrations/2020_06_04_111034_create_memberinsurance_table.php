<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberinsuranceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberinsurance', function (Blueprint $table) {
            $table->increments('id');
            $table->string('oid')->nullable()->comment('订单');
            $table->string('name')->nullable()->comment('姓名');
            $table->string('card')->nullable()->comment('身份证');
            $table->date('startdate')->nullable()->comment('开始日期');
            $table->date('enddate')->nullable()->comment('结束日期');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memberinsurance');
    }
}
