<link rel="stylesheet" href="https://unpkg.com/tailwindcss@%5E2/dist/tailwind.min.css">
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Todo Details
                        <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary btn-sm float-right">
                            Back
                        </a>
                    </div>

                    <div class="card-body">
                        <h5>Title: {{ $todo->title }}</h5>
                        <p>Description: {{ $todo->description }}</p>
                        <p>Completed: {{ $todo->completed ? 'Yes' : 'No' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
