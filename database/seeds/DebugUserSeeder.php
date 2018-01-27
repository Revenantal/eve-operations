<?php

use Carbon\Carbon;
use Database\DisableForeignKeys;
use Illuminate\Database\Seeder;

class DebugUserSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        //Add Debug Character, user id of 1
        $char = [
            [
                'id'                => 1,
                'character_id'      => 1,
                'character_name'    => 'SuperUser',
                'corporation_id'    => '1',
                'alliance_id'       => '1',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        DB::table('users')->insert($char);

        $this->enableForeignKeys();
    }
}