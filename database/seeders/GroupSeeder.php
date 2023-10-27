<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Group::factory(5)
            ->create()
            ->map(function ($group) {
                $teacher = User::role('teacher')->inRandomOrder()->first(['id']);
                $students = User::role('student')->inRandomOrder()->take(8)->get(['id']);

                $group->users()->attach($teacher);
                $group->users()->attach($students);
            });
    }
}
