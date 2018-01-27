<?php

use App\Models\Auth\Permission;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Database\TruncateTable;

class PermissionsTableSeeder extends Seeder
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
        $this->truncate('permissions');

        $permissions=[
            [
                'name' => 'admin-access',
                'display_name' => 'can access admin panel',
                'description' => 'Can access the admin panel'
            ],
            [
                'name' => 'role-read',
                'display_name' => 'Display Role Listing',
                'description' => 'See only Listing Of Role'
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Create Role',
                'description' => 'Create New Role'
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'Edit Role',
                'description' => 'Edit Role'
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Delete Role',
                'description' => 'Delete Role'
            ],
            [
                'name' => 'operation-view',
                'display_name' => 'Display available operations',
                'description' => 'See only available operations'
            ],
            [
                'name' => 'operation-create',
                'display_name' => 'Create operation',
                'description' => 'Create new operation'
            ],
            [
                'name' => 'operation-edit',
                'display_name' => 'Edit operation',
                'description' => 'Edit operation'
            ],
            [
                'name' => 'operation-delete',
                'display_name' => 'Delete operation',
                'description' => 'Delete operations'
            ]
        ];

        foreach ($permissions as $key=>$value){
            Permission::create($value);
        }

        $this->enableForeignKeys();
    }
}