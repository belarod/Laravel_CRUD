<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::apiResource('tasks', TaskController::class);
/**
 * Rotas da API para o gerenciamento das tarefas.
 */
