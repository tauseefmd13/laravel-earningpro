<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'user_management_access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'permission_access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'permission_create',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'permission_edit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'permission_show',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'permission_delete',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'role_access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'role_create',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'role_edit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'role_show',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'role_delete',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user_access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user_create',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user_edit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user_show',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user_delete',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Permission::insert($permissions);
    }
}
