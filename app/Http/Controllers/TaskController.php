<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Constructor to ensure only logged-in users can access
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Display the tasks
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->get(); 

        return view('tasks.index', compact('tasks'));
    }

    // Show form to create a new task
    public function create()
    {
        return view('tasks.create');
    }

    // Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:pending,in-progress,completed',
            'due_date' => 'required|date'
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'user_id' => Auth::id()  // Associate task with logged-in user
        ]);

        return redirect()->route('tasks.index');
    }

    // Show a specific task for editing
    public function edit(Task $task)
    {
        // Ensure task belongs to the authenticated user
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized');
        }

        return view('tasks.edit', compact('task'));
    }

    // Update a specific task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:pending,in-progress,completed',
            'due_date' => 'required|date'
        ]);

        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized');
        }

        $task->update($request->all());

        return redirect()->route('tasks.index');
    }

    // Delete a task
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized');
        }

        $task->delete();

        return redirect()->route('tasks.index');
    }
}

