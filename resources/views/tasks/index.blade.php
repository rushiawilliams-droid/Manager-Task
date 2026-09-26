@extends('layouts.app')

@section('title', 'All Tasks')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <h1 class="text-2xl font-bold text-gray-900">Task List</h1>
    
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex gap-1 bg-gray-200 p-1 rounded-lg text-sm font-medium">
            <a href="/tasks" class="px-3 py-1.5 rounded-md bg-white text-gray-900 shadow-sm">All</a>
            <a href="/tasks?status=Pending" class="px-3 py-1.5 rounded-md text-gray-600 hover:text-gray-900">Pending</a>
            <a href="/tasks?status=Completed" class="px-3 py-1.5 rounded-md text-gray-600 hover:text-gray-900">Completed</a>
        </div>

        <a href="/tasks/create" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium text-sm transition">
            + Add Task
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    @if($tasks->isEmpty())
        <div class="p-8 text-center text-gray-500">
            No tasks found. Click "<a href="/tasks/create" class="text-indigo-600 font-semibold hover:underline">+ Add Task</a>" to create one.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Task Name</th>
                        <th class="px-6 py-4">Description</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Due Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @foreach($tasks as $task)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $task->task_name }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $task->description ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($task->status === 'Completed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Completed
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No Due Date' }}
                            </td>
                            <td class="px-6 py-4 text-right flex justify-end gap-2">
                                <a href="/tasks/{{ $task->id }}/edit" class="text-indigo-600 hover:text-indigo-900 font-medium">
                                    Edit
                                </a>
                                <form action="/tasks/{{ $task->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium ml-2">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection