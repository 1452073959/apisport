<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaseTenancyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lease_tenancy', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('方式名称');
            $table->text('description')->nullable()->comment('租赁描述');
            $table->decimal('price')->nullable()->comment('租赁价格');
            $table->integer('venue_id')->nullable()->comment('所属场馆');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lease_tenancy');
    }
}
