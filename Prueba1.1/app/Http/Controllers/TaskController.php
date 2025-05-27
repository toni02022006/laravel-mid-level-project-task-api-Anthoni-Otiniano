<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Builder;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Task::query();

        // Filtro por status
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filtro por priority
        if ($request->has('priority')) {
            $query->where('priority', $request->input('priority'));
        }

        // Filtro por due_date
        if ($request->has('due_date')) {
            $query->whereDate('due_date', $request->input('due_date'));
        }

        // Filtro por project_id
        if ($request->has('project_id')) {
            $query->where('project_id', $request->input('project_id'));
        }

        $tasks = $query->get();

        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::create($request->validated());
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): JsonResponse
    {
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->validated());
        return response()->json($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->delete(); // Elimina la tarea de la base de datos

        // Retornar una respuesta 204 No Content para indicar que fue exitoso pero no hay contenido
        return response()->json(null, 204);
    }
}