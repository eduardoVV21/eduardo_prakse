@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        All Todos
                        <a href="{{ route('todos.create') }}" class="btn btn-primary btn-sm float-right">
                            <i class="fas fa-plus"></i> Create New
                        </a>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($todos as $todo)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>{{ $todo->title }}</span>
                                        <a href="{{ route('todos.edit', ['id' => $todo->id]) }}" class="btn btn-info btn-sm">Edit</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
