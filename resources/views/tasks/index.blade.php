@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Your Tasks</h1>

    <a href="{{ route('tasks.create') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Create Task</a>

    <table class="table-auto w-full mt-6 border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">Title</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Due Date</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($tasks->isNotEmpty())
                @foreach($tasks as $task)
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $task->title }}</td>
                        <td class="px-4 py-2 border">{{ ucfirst($task->status) }}</td>
                        <td class="px-4 py-2 border">{{ $task->due_date }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Edit</a>
                            
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="px-4 py-2 border text-center">No tasks found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
