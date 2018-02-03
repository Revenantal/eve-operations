<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Database\TruncateTable;

class RoleTableSeeder extends Seeder
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
        $this->truncate('roles');

        //Add Admin Role, user id of 1
        $admin = [
            [
                'id'                => 1,
                'name'              => 'Admin',
                'display_name'      => 'Admin',
                'description'       => 'Administrator',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => 2,
                'name'              => 'User',
                'display_name'      => 'User',
                'description'       => 'General User',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        DB::table('roles')->insert($admin);


        $this->truncate('permission_role');

        // Set Admin Permissions
        $permRole = [
            [
                'permission_id'     => 1,
                'role_id'           => 1,
            ],
            [
                'permission_id'     => 6,
                'role_id'           => 2,
            ],
        ];

        DB::table('permission_role')->insert($permRole);

        $this->enableForeignKeys();
    }
}
