<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTableToEveSso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            // Adds
            $table->char('eve_token', 100);
            $table->char('username', 50);
            $table->carchar('avatar', 255);
            $table->softDeletes();

            // Drops
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('eve_token');
        $table->dropColumn('username');
        $table->dropColumn('deleted_at');
        $table->dropColumn('image');
    }
}
