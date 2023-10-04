<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Task;
use HasFactory;
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
        return [
            'title' => $this->faker->sentence(
                rand(3, 8)
            ),

            'content' => $this->faker->sentence(
                rand(8, 16)
            ),

            'status' => $this->faker->randomElement(
                Task::getAvailableStatuses()
            ),
        ];
    }
}
