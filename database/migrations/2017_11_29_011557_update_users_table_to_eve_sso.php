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
            $table->char('avatar', 255);
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('eve_token');
            $table->dropColumn('username');
            $table->dropColumn('deleted_at');
            $table->dropColumn('image');

            // Reset to original table structure to prevent issues
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
        });
    }
}
