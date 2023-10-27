<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //      |-----------------------NOTICE-------------------------------------------|
//      |  gets all permissions via Gate::before rule; check AuthServiceProvider |
        Role::create(['name' => 'admin']);
//      |------------------------------------------------------------------------|

        $roleStudent = Role::create(['name' => 'student']);

        $studentPermissionActions = [
            'group_access',
            'group_show',
            'task_access',
            'task_show',
            'answer_access',
            'answer_show',
            'answer_create',
            'answer_update',
            'answer_delete',
        ];
            foreach ($studentPermissionActions as $action)
            {
                $roleStudent->givePermissionTo($action);
            }

        $roleTeacher = Role::create(['name' => 'teacher']);

        $teacherPermissionActions = [
            'group_access',
            'group_show',
            'task_access',
            'task_show',
            'task_create',
            'task_update',
            'task_delete',
            'answer_access',
            'answer_show',
            'answer_create',
            'answer_update',
            'answer_delete',
        ];
        foreach ($teacherPermissionActions as $action)
        {
            $roleTeacher->givePermissionTo($action);
        }
    }
}
