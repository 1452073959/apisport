<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSVenueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_venue', function (Blueprint $table) {
            $table->increments('id');
            $table->string('venuename')->default('')->comment('场馆名称');
            $table->string('address')->default('')->comment('场馆地址');
            $table->text('label')->nullable()->comment('标签');
            $table->string('venueimg')->default('')->comment('场地图片');
            $table->string('tel')->default('')->comment('电话');
            $table->time('starttime')->comment('开始时间');
            $table->time('endtime')->comment('结束时间');
            $table->text('venuesynopsis')->comment('场地介绍');
            $table->text('venuefacility')->comment('场地设施');
            $table->text('venueserve')->comment('场地服务');
            $table->decimal('price')->nullable()->comment('价格');
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
        Schema::dropIfExists('s_venue');
    }
}
