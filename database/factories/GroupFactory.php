<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = Carbon::createFromTime(
            fake()->randomElement([9, 10, 14, 16, 18]), // Случайный час начала урока
            fake()->randomElement([0, 30]), // Случайные минуты (0, 30)
        );

        // Добавляем случайное количество минут для времени окончания урока (например, 45, 60, 75, 90 минут)
        $endTime = $startTime->copy()->addMinutes(90);

        $name = rand(15, 100).'-'.fake()->randomElement(['WEB', 'FOUNDATION']);
        return [
            'name' => $name,
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
        ];
    }
}
