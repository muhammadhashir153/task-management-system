<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskControllerApi extends Controller
{
    // Get all tasks for the authenticated user
    public function index(Request $request)
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    // Create a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'user_id' => $request->user()->id, // Associate with authenticated user
        ]);

        return response()->json($task, 201);
    }

    // Get a specific task by ID
    public function show(Request $request, Task $task)
    {
        // if ($task->user_id !== $request->user()->id) {
        //     return response()->json(['error' => 'Unauthorized'], 403);
        // }
        $tasks = Task::find($task);
        return response()->json($tasks);
    }

    // Update an existing task
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $task->update($request->only('title', 'description', 'status', 'due_date'));
        return response()->json($task);
    }

    // Delete a task
    public function destroy(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
