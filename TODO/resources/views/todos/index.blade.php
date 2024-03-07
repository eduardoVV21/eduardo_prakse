<link rel="stylesheet" href="https://unpkg.com/tailwindcss@%5E2/dist/tailwind.min.css">
@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full md:w-3/4 lg:w-2/3">
                <div class="bg-white shadow-md rounded-md">
                    <div class="p-4 bg-gray-100 border-b border-gray-200 flex justify-between items-center">
                        <span class="text-lg font-semibold">All Todos</span>
                        <div class="flex items-center">
    <a href="{{ route('todos.create') }}" class="btn btn-primary btn-sm rounded-full p-1 shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </a>
    <a href="{{ route('shared.todos') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center ml-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span>Shared Todos</span>
    </a>
</div>
                    </div>

                    <div class="p-4">
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
                            <ul class="divide-y divide-gray-200">
                                @foreach($todos as $todo)
                                    <li class="flex items-center justify-between py-3">
                                        <div class="flex items-center">
                                            <button onclick="event.preventDefault(); document.querySelector('form#complete-{{ $todo->id }}').submit();" class="mr-2" style="color: {{ $todo->completed ? 'green' : 'gray' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <form id="complete-{{ $todo->id }}" style="display:none" method="post" action="{{ route('todos.complete', ['id' => $todo->id]) }}">
                                                    @csrf 
                                                    @method('put')
                                                </form>
                                            </button>
                                            <span class="cursor-pointer" onclick="redirectToTasksIndex('{{ $todo->id }}')">{{ $todo->title }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <a href="{{ route('todos.edit', ['id' => $todo->id]) }}" class="mr-2">
                                                <button class="p-2 border border-gray-300 rounded-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                </button>
                                            </a>

                                            <button onclick="openShareModal('{{ $todo->id }}')" class="mr-2 p-2 border border-gray-300 rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                                                </svg>
                                            </button> <form id="deleteForm-{{ $todo->id }}" action="{{ route('todos.destroy', ['id' => $todo->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('{{ $todo->id }}')" style="color: red;" class="mr-2 p-2 border border-gray-300 rounded-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
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

    <div id="shareModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg p-6 w-96">
            <h2 class="text-lg font-semibold mb-4">Share Todo</h2>
            <form id="shareTodoForm" action="{{ route('share.todo') }}" method="POST">
                @csrf
                <input type="hidden" name="todo_id" id="todo_id">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" required class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-700">Message:</label>
                    <textarea id="message" name="message" rows="3" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">Share</button>
                    <button type="button" onclick="closeShareModal()" class="ml-2 bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function confirmDelete(todoId) {
        if (confirm('Are you sure you want to delete this todo?')) {
            document.getElementById('deleteForm-' + todoId).submit();
        }
    }

    function redirectToTasksIndex(todoId) {
        window.location = "/todos/" + todoId + "/tasks/index";
    }

    function openShareModal(todoId) {
        var modal = document.getElementById('shareModal');
        if (modal) {
            modal.classList.remove('hidden');
            document.getElementById('todo_id').value = todoId;
        }
    }

    function closeShareModal() {
        var modal = document.getElementById('shareModal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    document.getElementById('shareTodoForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var form = event.target;
        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log(response); 
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Something went wrong');
            }
        })
        .then(data => {
            console.log(data); 
            alert(data.message);
            closeShareModal();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to share todo. Error: ' + error);
        });
    });
    </script>

@endsection
