<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cardname')->default('')->comment('卡名');
            $table->string('deadline')->default('')->comment('时间');
            $table->decimal('price')->comment('//价格');
            $table->string('explain')->default('')->comment('说明');
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
        Schema::dropIfExists('s_member');
    }
}
