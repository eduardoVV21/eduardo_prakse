<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">

@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white border-t-4 border-indigo-600 rounded-lg shadow-xl">
                <div class="py-4 px-6">
                    <!-- <div class="text-lg font-semibold mb-4">Create Task</div> -->
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-lg font-semibold font-medium">Create Task</span>
                        <a href="{{ route('tasks.index', $todo_id) }}" class="btn btn-outline-secondary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                    </div>
                    <form id="taskForm" method="POST" action="{{ route('tasks.store', $todo_id) }}">
                        @csrf

                        <div id="task_fields">
                            <div class="form-group mb-3">
                                <div class="flex items-center">
                                    <input id="taskInput" type="text" name="task_name[]" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter Task Name" required>
                                    <button type="button" onclick="removeField(this)" class="btn-danger ml-2 p-2 rounded-full text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ">
  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
</svg>

                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between">
    <button type="submit" class="btn btn-primary">Create Task</button>
    <button type="button" onclick="addMoreFields()" class="btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Add
    </button>
</div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function addMoreFields() {
        var container = document.getElementById('task_fields');
        var field = document.createElement('div');
        field.className = 'form-group mb-3';
        field.innerHTML = `
            <div class="flex items-center">
                <input type="text" name="task_name[]" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter Task Name" required>
                <button type="button" onclick="removeField(this)" class="btn-danger ml-2 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500 hover:text-red-700">
  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
</svg>

                </button>
            </div>
        `;
        container.appendChild(field);
    }

    function removeField(button) {
        button.parentNode.parentNode.remove();
    }

    // Client-side form validation
    document.getElementById('taskForm').addEventListener('submit', function(event) {
        var taskInput = document.getElementById('taskInput');
        if (!taskInput.value.trim()) {
            alert('Please enter a task name.');
            event.preventDefault(); // Prevent form submission
        }
    });
</script>
@endsection
