<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo các quyền (Permissions)
        $permissions = [
            'list users',
            'add users',
            'details users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

         // Tạo các vai trò (Roles) và gán quyền cho vai trò
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $agentRole = Role::firstOrCreate(['name' => 'agent']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

    // Gán tất cả các quyền cho Admin
        $adminRole->syncPermissions(Permission::all());
    }
}