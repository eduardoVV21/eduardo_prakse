<link rel="stylesheet" href="https://unpkg.com/tailwindcss@%5E2/dist/tailwind.min.css">
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        All Todos
                        <a href="{{ route('todos.create') }}" class="btn btn-primary btn-sm float-right rounded-full p-0 shadow-md">
                            <button><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg></button>
                        </a>
                    </div>

                    <div class="card-body">
                        @if(session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if($todos->isEmpty())
                            <div class="alert alert-info" role="alert">
                                There are no todo lists. Please create one.
                            </div>
                        @else
                            <ul class="list-group">
                                @foreach($todos as $todo)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="flex">
                                                <button onclick="event.preventDefault(); document.querySelector('form#complete-{{ $todo->id }}').submit();" class="mr-2" style="color: {{ $todo->completed ? 'green' : 'gray' }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <form id="complete-{{ $todo->id }}" style="display:none" method="post" action="{{ route('todos.complete', ['id' => $todo->id]) }}">
                                                        @csrf 
                                                        @method('put')
                                                    </form>
                                                </button>
                                                <span class="cursor-pointer" onclick="window.location='{{ route('todos.show', ['id' => $todo->id]) }}';">{{ $todo->title }}</span> <!-- Updated with cursor-pointer class and onclick event -->
                                            </div>
                                            <div class="flex">
                                                <a href="{{ route('todos.edit', ['id' => $todo->id]) }}" class="mr-2">
                                                    <button><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg></button>
                                                </a>

                                                <form id="deleteForm-{{ $todo->id }}" action="{{ route('todos.destroy', ['id' => $todo->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="confirmDelete('{{ $todo->id }}')" style="color: red;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(todoId) {
            if (confirm('Are you sure you want to delete this todo?')) {
                document.getElementById('deleteForm-' + todoId).submit();
            }
        }
    </script>
@endsection
