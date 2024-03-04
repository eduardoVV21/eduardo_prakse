<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">

@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white border-t-4 border-indigo-600 rounded-lg shadow-xl">
                <div class="py-4 px-6">
                    <div class="text-lg font-semibold mb-4">Edit Task</div>
                    <form method="POST" action="{{ route('tasks.update', ['todo_id' => $todo_id, 'task_id' => $task->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            @php
                            $tasks = json_decode($task->tasks);
                            @endphp
                            @if(is_array($tasks))
                            @foreach($tasks as $index => $task)
                            <div class="mb-3">
                                <label for="task_{{ $index }}" class="block text-sm font-medium text-gray-700">Task {{ $index + 1 }}</label>
                                <input id="task_{{ $index }}" type="text" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="task_data[{{ $index }}]" value="{{ $task }}" required>
                            </div>
                            @endforeach
                            @endif
                        </div>

                        <div class="flex justify-between">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('tasks.index', ['todo_id' => $todo_id]) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Piesaistīt kārtas numuru katram uzdevumam
    window.onload = function() {
        var inputs = document.querySelectorAll('[id^="task_"]');
        inputs.forEach(function(input, index) {
            input.placeholder = "Task " + (index + 1);
        });
    };
</script>
@endsection
