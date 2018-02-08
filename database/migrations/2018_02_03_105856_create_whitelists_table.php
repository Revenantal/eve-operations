<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhitelistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whitelists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporation_id');
            $table->string('corporation_name');
            $table->integer('alliance_id')->default(1);
            $table->string('alliance_name')->default('Leviathan(System)');
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
        Schema::dropIfExists('whitelists');
    }
}
