<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all(); //arrumar com api resource
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pendente,em andamento,concluido',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create($validated);

        return response()->json($task, 201); //arrumar com api resource
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        if ($task->status !== 'pendente') {
            return response()->json(['error' => 'Apenas tarefas com status "PENDENTE" podem ser alteradas.']); //arrumar com api resource
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pendente,em andamento,concluido',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return response()->json($task); //arrumar com api resource
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        if ($task->status !== 'pendente') {
            return response()->json(['error' => 'Apenas tarefas com status "PENDENTE" podem ser excluídas.']); //arrumar com api resource
        }

        $task->delete();

        return response()->json(['message' => 'Task '+$id+'deletada com sucesso.']); //arrumar com api resource
    }
}
