<?php

use Carbon\Carbon;
use Database\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Database\TruncateTable;

class DebugUserSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('users');

        //Add Debug Character, user id of 1
        $char = [
            [
                'id'                => 1,
                'character_id'      => 1,
                'character_name'    => 'SuperUser',
                'corporation_id'    => '1',
                'corporation_name'  => 'System',
                'alliance_id'       => '1',
                'alliance_name'     => 'Leviathan(System)',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        DB::table('users')->insert($char);

        $this->enableForeignKeys();
    }
}