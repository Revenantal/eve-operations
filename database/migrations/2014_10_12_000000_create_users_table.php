<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('character_id');
            $table->string('character_name');
            $table->integer('corporation_id');
            $table->integer('alliance_id')->default('0');
            $table->boolean('admin')->default(false);
            $table->timestamp('last_login')->nullable();
            $table->rememberToken(); //Keeps causing issues so just adding it so the tool keeps working
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
        Schema::dropIfExists('users');
    }
}