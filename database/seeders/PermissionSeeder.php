<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = array(
            'post_create',
            'post_update',
            'post_delete',
            'post_show',
            'post_list',
        );

        foreach ($permissions as $p) {
            Permission::create(['name' => $p]);
        }
    }
}
