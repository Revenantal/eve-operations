<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('operation_id');
            $table->char('name');
            $table->char('value');
            $table->boolean('hidden')->default(false); // Used for determing if an attribute will be publicly (no roles) viewable, or only organizer+
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operation_attributes');
    }
}
