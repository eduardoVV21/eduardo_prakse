<!-- resources/views/todos/create.blade.php -->

<!-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create new Todo</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('todos.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1.0">
    <title>Todos</title>
</head>
<body>
    <div>
        <h1>What next you need to To-Do</h1>
        <form methode="post" action="/todo/cretae">
            @csrf 
            <input type="text" name="title"/>
            <input type="submit" value="Create"/>

        </form>
    </div>
</body>
</html>
