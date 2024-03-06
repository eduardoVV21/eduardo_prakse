<link rel="stylesheet" href="https://unpkg.com/tailwindcss@%5E2/dist/tailwind.min.css">

@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full md:w-3/4 lg:w-2/3">
                <div class="bg-white shadow-md rounded-md">
                    <div class="p-4 bg-gray-100 border-b border-gray-200 flex justify-between items-center">
                        <span class="text-lg font-semibold">Shared Todos</span>
                        <a href="{{ route('todos.index') }}" class="flex items-center text-gray-600 hover:text-black-700 hover:bg-gray-100 px-3 py-2 rounded-md">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-6 h-6 mr-2">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
    Back
</a>

                    </div>

                    <div class="p-4">
                        @if($sharedTodos->isEmpty())
                            <div class="alert alert-info" role="alert">
                                There are no shared todos.
                            </div>
                        @else
                            <ul class="divide-y divide-gray-200">
                                @foreach($sharedTodos as $todo)
                                    <li class="flex items-center justify-between py-3">
                                        <div class="flex items-center">
                                            <span class="cursor-pointer">{{ $todo->title }}</span>
                                            <span class="ml-2 text-sm text-gray-500">{{ $todo->description }}</span>
                                            <!-- Add more elements to display additional information -->
                                        </div>
                                        <div class="flex items-center">
                                            <a href="{{ route('todos.edit', ['id' => $todo->id]) }}" class="mr-2">
                                                <button class="p-2 border border-gray-300 rounded-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                </button>
                                            </a>
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
@endsection
