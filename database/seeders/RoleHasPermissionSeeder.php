<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  admin
        $admin = Role::find(1);
        $permissions = Permission::all();
        $admin->syncPermissions($permissions);

        //  responsable
        $responsable = Role::find(2);
        $rollback_permissions_responsable = [
            'post_delete',
        ];
        foreach ($permissions as $p) {
            if (!in_array($p, $rollback_permissions_responsable)) {
                $responsable->syncPermissions($p);
            }
        }
        $responsable->syncPermissions($permissions);
    }
}
