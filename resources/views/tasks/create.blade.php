@extends('layouts.app')

@section('title', 'Create New Task')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="mb-6 flex items-center justify-between border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-900">Create New Task</h1>
        <a href="/tasks" class="text-sm font-medium text-gray-500 hover:text-gray-700">← Back to List</a>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/tasks" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="task_name" class="block text-sm font-medium text-gray-700 mb-1">Task Name *</label>
            <input type="text" name="task_name" id="task_name" value="{{ old('task_name') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div>
            <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t">
            <a href="/tasks" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Cancel</a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition">Save Task</button>
        </div>
    </form>
</div>
@endsection