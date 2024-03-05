<link rel="stylesheet" href="https://unpkg.com/tailwindcss@%5E2/dist/tailwind.min.css">
@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full md:w-2/3 lg:w-1/2">
            <div class="bg-white shadow-md rounded-md">
                <div class="bg-gray-100 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                    <span class="text-lg font-semibold">Edit Todo</span>
                    <a href="{{ route('todos.index') }}" class="text-gray-600 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                </div>

                <div class="p-6">
                    @if ($errors->any())
                    <div class="alert alert-danger flex justify-between items-center">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button class="close" onclick="removeAlert(this)">&times;</button> <!-- Close button -->
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success flex justify-between items-center">
                        {{ session('success') }}
                        <button class="close" onclick="removeAlert(this)">&times;</button> <!-- Close button -->
                    </div>
                    @endif

                    @if(session('warning'))
                    <div class="alert alert-warning flex justify-between items-center">
                        {{ session('warning') }}
                        <button class="close" onclick="removeAlert(this)">&times;</button> <!-- Close button -->
                    </div>
                    @endif

                    <form method="POST" action="{{ route('todos.update', ['id' => $todo->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-semibold text-gray-600">Title:</label>
                            <input type="text" name="title" id="title" class="form-control mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $todo->title }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-semibold text-gray-600">Description:</label>
                            <textarea name="description" id="description" class="form-control mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="3">{{ $todo->description }}</textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update</button>
                            <a href="{{ route('todos.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function removeAlert(element) {
        element.parentElement.remove();
    }
</script>

@endsection
