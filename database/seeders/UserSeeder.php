<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        DB::table('users')->truncate();

       User::factory()->create([
            'name' => 'AdminBek',
            'email' => 'admin777@fake.com',
        ])
        ->assignRole('admin');

       User::factory()->create([
            'name' => 'Big Teacher',
            'email' => 'teacherBig@fake.com',
        ])
        ->assignRole('teacher');

       User::factory()->create([
            'name' => 'Head Teacher',
            'email' => 'teacherHead@fake.com',
        ])
        ->assignRole('teacher');

       User::factory()->create([
            'name' => 'Ethical Hacker',
            'email' => 'ethack106@fake.com',
        ])
        ->assignRole('student');

       User::factory(10)->create()->map(function ($student) {
          $student->assignRole('student');
       });
    }
}
