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
        // I am seeding only 2 teachers, so i use this "trick" with oldest() and latest() scopes.
        $firstTeacher = User::role('teacher')->oldest('id')->first(['id']);
        Group::factory(3)
            ->create()
            ->map(function ($group) use ($firstTeacher) {
                $students = User::role('student')->inRandomOrder()->take(8)->get(['id']);

                $group->users()->attach($firstTeacher);

                $group->users()->attach($students);
            });

        $secondTeacher = User::role('teacher')->latest('id')->first(['id']);
        Group::factory(3)
            ->create()
            ->map(function ($group) use ($secondTeacher) {
                $students = User::role('student')->inRandomOrder()->take(8)->get(['id']);

                $group->users()->attach($secondTeacher);

                $group->users()->attach($students);
            });
    }
}
