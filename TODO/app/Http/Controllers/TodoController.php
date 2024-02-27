<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Todo;
use App\Http\Requests\TodoCreateRequest;
class TodoController extends Controller
{
   
        public function index()
        {
            $todos = Todo::all();
            return view('todos.index', compact('todos'));
        }
    
        public function create()
        {
            return view('todos.create');   
        }

        public function store(TodoCreateRequest $request)
{
    // The request will automatically be validated
    $data = $request->validated();

    $data['completed'] = 0; // Assuming 'completed' field is an integer
    Todo::create($data);
    
    return redirect()->route('todos.create')->with('success', 'Todo created successfully');
}


public function edit($id)
{
    // Find the todo item by ID
    $todo = Todo::findOrFail($id);

    // Return the edit view with the todo item data
    return view('todos.edit', compact('todo'));
}
    
    
///////////////////////
public function update(Request $request, $id)
{
    $todo = Todo::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Check if the new title is different from the existing title
    if ($request->title === $todo->title) {
        return redirect()->back()->with('warning', 'No changes were made to the todo.');
    }

    $todo->title = $request->title;
    $todo->save();

    return redirect()->back()->with('success', 'Todo updated successfully');
}


    /**
     * Store a newly created resource in storage.
     */
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   

    /**
     * Update the specified resource in storage.
     */
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
