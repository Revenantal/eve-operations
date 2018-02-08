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
                'name'              => 'fleetcommander',
                'display_name'      => 'Fleet Commander',
                'description'       => 'Fleet Commander',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => 3,
                'name'              => 'User',
                'display_name'      => 'User',
                'description'       => 'General User',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        DB::table('roles')->insert($admin);


        $this->truncate('permission_role');

        // Set Role Permissions
        $permRole = [
            // Admin
            [
                'permission_id'     => 1,
                'role_id'           => 1,
            ],
            [
                'permission_id'     => 2,
                'role_id'           => 1,
            ],
            [
                'permission_id'     => 3,
                'role_id'           => 1,
            ],
            [
                'permission_id'     => 4,
                'role_id'           => 1,
            ],
            [
                'permission_id'     => 5,
                'role_id'           => 1,
            ],
            [
                'permission_id'     => 6,
                'role_id'           => 1,
            ],
            [
                'permission_id'     => 7,
                'role_id'           => 1,
            ],
            [
                'permission_id'     => 8,
                'role_id'           => 1,
            ],
            [
                'permission_id'     => 9,
                'role_id'           => 1,
            ],
            // FC
            [
                'permission_id'     => 6,
                'role_id'           => 2,
            ],
            [
                'permission_id'     => 7,
                'role_id'           => 2,
            ],
            [
                'permission_id'     => 8,
                'role_id'           => 2,
            ],
            // User
            [
                'permission_id'     => 6,
                'role_id'           => 3,
            ],
        ];

        DB::table('permission_role')->insert($permRole);

        $this->truncate('role_user');

        $admin = [
            [
                'user_id'           => 1,
                'role_id'           => 1,
            ],
        ];

        DB::table('role_user')->insert($admin);

        $this->enableForeignKeys();
    }
}
