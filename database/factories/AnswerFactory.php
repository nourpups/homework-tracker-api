<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $task_id = Task::inRandomOrder()->first(['id']);
        $student_id = User::role('student')->inRandomOrder()->first(['id']);

        return [
            'task_id' => $task_id,
            'student_id' => $student_id,
            'text' => fake()->paragraph(),
        ];
    }
}
