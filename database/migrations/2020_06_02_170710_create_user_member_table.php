<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_member', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->timestamp('end_time')->comment('会员到期时间');
            $table->string('code')->default('')->comment('会员码');
            $table->string('membership')->nullable()->comment('会员到期?');
            $table->string('codenot')->nullable()->comment('当天会员码是否已使用');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_member');
    }
}
