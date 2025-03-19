<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    
    public function index()
    {
        /**
         * Exibe uma lista de tarefas.
         *
         * @return \Illuminate\Http\JsonResponse
         */

        $tasks = Task::all();
        return response()->json(TaskResource::collection($tasks), 200);
    }

    public function store(Request $request)
    {
        /**
         * Armazena uma nova tarefa no banco de dados.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\JsonResponse
         */

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pendente,em andamento,concluido',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create($validated);

        return response()->json(new TaskResource($task), 201);
    }

    public function update(Request $request, $id)
    {
        /**
         * Atualiza uma tarefa existente.
         * Somente tarefas com status 'pendente' podem ser atualizadas.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\JsonResponse
         */

        $task = Task::findOrFail($id);
        if ($task->status !== 'pendente') {
            return response()->json(['error' => 'Apenas tarefas com status "PENDENTE" podem ser alteradas.'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pendente,em andamento,concluido',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return response()->json(new TaskResource($task), 200);
    }

    public function destroy($id)
    {
        /**
         * Remove uma tarefa do banco de dados.
         * Somente tarefas com status 'pendente' podem ser excluídas.
         *
         * @param  int  $id
         * @return \Illuminate\Http\JsonResponse
         */
        
        $task = Task::findOrFail($id);
        if ($task->status !== 'pendente') {
            return response()->json(['error' => 'Apenas tarefas com status "PENDENTE" podem ser excluídas.'], 403);
        }

        $task->delete();

        return response()->json(['message' => "Tarefa {$id} deletada com sucesso.",
            'task' => new TaskResource($task)], 200);
    }
}
