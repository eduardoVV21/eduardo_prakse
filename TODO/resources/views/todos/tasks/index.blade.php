<link rel="stylesheet" href="https://unpkg.com/tailwindcss@%5E2/dist/tailwind.min.css">
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        All Tasks
                        <a href="{{ route('tasks.create', ['todo_id' => $todo_id]) }}" class="btn btn-primary btn-sm float-right">Create Task</a>
                    </div>

                    <div class="card-body">
                        @if(session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if($tasks->isEmpty())
                            <div class="alert alert-info" role="alert">
                                There are no tasks yet.
                            </div>
                        @else
                            <div class="grid grid-cols-1 gap-4">
                                @foreach($tasks as $task)
                                    <div class="border rounded p-4">
                                        <p class="mb-4">Task ID: {{ $task->id }}</p>
                                        @foreach(json_decode($task->tasks) as $taskName)
                                            <div class="flex justify-between items-center border rounded px-3 py-2 mt-2 mb-2">
                                                <span>{{ $taskName }}</span>
                                                <div>
                                                <a href="#" class="btn btn-sm">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600">
        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
    </svg>
</a>
                                                <a href="#" class="btn btn-sm">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-600">
        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
    </svg>
</a>


                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('todos.index') }}" class="btn btn-secondary">Back to Todos</a>
                </div>
            </div>
        </div>
    </div>
@endsection
