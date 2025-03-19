<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * Cria dados fictícias no banco de dados.
         *
         * @return void
         */
        Task::factory()->count(10)->create();
    }
}
