<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">

@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white border-t-4 border-indigo-600 rounded-lg shadow-xl">
                <div class="py-4 px-6">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold">All Tasks for Todo {{ $todo_id }}</span>
                        <div class="flex space-x-2">
                            <a href="{{ route('todos.index') }}" class="btn btn-secondary btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                            <a href="{{ route('tasks.create', ['todo_id' => $todo_id]) }}" class="btn btn-primary btn-sm">Create Task</a>
                        </div>
                    </div>
                    <div class="mt-4">
                        @if(session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        @if($tasks->isEmpty())
                        <div class="alert alert-info" role="alert">
                            There are no tasks for this todo yet.
                        </div>
                        @else
                        <div class="grid grid-cols-1 gap-4 mt-4">
                            @foreach($tasks as $task)
                            <div class="border rounded-lg p-4">
                                @php
                                $taskNames = json_decode($task->tasks);
                                @endphp
                                @if(is_array($taskNames))
                                @foreach($taskNames as $index => $taskName)
                                <div class="flex justify-between items-center border-b py-2">
                                    <span>{{ is_string($taskName) ? $taskName : $taskName->name }}</span>
                                    <button class="text-red-500 hover:text-red-700" onclick="confirmDelete({{ $loop->index }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                                @endforeach
                                @else
                                <div class="alert alert-danger" role="alert">
                                    Invalid task data.
                                </div>
                                @endif
                                <div class="flex justify-end mt-2">
                                    <a href="{{ route('tasks.edit', ['todo_id' => $todo_id, 'task' => $task->id]) }}" class="btn-primary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <input type="hidden" name="task_index" id="task_index">
</form>

<script>
    function confirmDelete(taskIndex) {
        if (confirm("Are you sure you want to delete this task?")) {
            deleteTask(taskIndex);
        }
    }

    function deleteTask(taskIndex) {
        var form = document.getElementById('deleteForm');
        form.action = '/tasks/{{ $todo_id }}';
        document.getElementById('task_index').value = taskIndex;
        form.submit();
    }

    // Display alert if there is a success message in the session
    @if(session('success'))
        alert("{{ session('success') }}");
    @endif
</script>
@endsection
