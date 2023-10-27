<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissionEntities = ['user', 'answer', 'group', 'task', 'role', 'permission']; //
        $permissionActions = ['access', 'show', 'create', 'update', 'delete'];

        foreach($permissionEntities as $permissionEntity)
        {
            foreach ($permissionActions as $permissionAction)
            {
                Permission::create(['name' =>  $permissionEntity.'_'.$permissionAction]);
            }
        }
    }
}
