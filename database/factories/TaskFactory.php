<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [

            'task_code' => 'TSK'.$this->faker->unique()->numberBetween(1000,9999),

            'title' => $this->faker->sentence(3),

            'description' => $this->faker->paragraph(),

            'assigned_to' => $this->faker->name(),

            'priority' => $this->faker->randomElement([

                'Low',

                'Medium',

                'High'

            ]),

            'status' => $this->faker->randomElement([

                'Pending',

                'In Progress',

                'Completed',

                'Cancelled'

            ]),

            'start_date' => now(),

            'due_date' => now()->addDays(rand(1,15)),

            'completed_at' => null,

        ];
    }
}