<?php

namespace Database\Factories;

use App\Enum\Role;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $group_id = Group::inRandomOrder()->first(['id']);
        return [
            'description' => fake()->paragraph(),
            'group_id' => $group_id,
            'deadline' => fake()->dateTimeBetween('now', '+1 month')
        ];
    }
}
