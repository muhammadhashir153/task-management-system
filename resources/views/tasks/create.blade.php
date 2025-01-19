@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Create a New Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" id="title" class="mt-1 block w-full border border-gray-300 rounded p-2" required>
        </div>
        
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded p-2" required></textarea>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded p-2">
                <option value="pending">Pending</option>
                <option value="in-progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <div>
            <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
            <input type="datetime-local" name="due_date" id="due_date" class="mt-1 block w-full border border-gray-300 rounded p-2" required>
        </div>

        <div>
            <button type="submit" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-700">Create Task</button>
        </div>
    </form>
</div>
@endsection
