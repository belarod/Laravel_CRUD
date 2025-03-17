<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = \App\Models\Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pendente', 'em andamento', 'concluido']),
            'due_date' => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
        ];
    }
}
