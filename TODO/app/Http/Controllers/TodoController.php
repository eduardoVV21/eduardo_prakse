<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Todo;
use App\Http\Requests\TodoCreateRequest;
use Illuminate\Support\Facades\Auth;
class TodoController extends Controller
{
   public function __construct()
   {
    $this->middleware('auth');
   }

        public function index()
        {
            $todos = auth()->user()->todos()->orderBy('completed')->get();
          // return $todos;
           // $todos = Todo::orderBy('completed')->get();
            return view('todos.index', compact('todos'));
        }
    
        public function create()
        {
            return view('todos.create');   
        }

        public function store(TodoCreateRequest $request)
{
    $data = $request->validated();
    $data['completed'] = 0; // Assuming 'completed' field is an integer

    $data['user_id'] = auth()->id(); // Assigning user_id

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
        'description' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Check if the new title and description are different from the existing ones
    if ($request->title === $todo->title && $request->description === $todo->description) {
        return redirect()->back()->with('warning', 'No changes were made to the todo.');
    }

    $todo->title = $request->title;
    $todo->description = $request->description;
    $todo->save();

    return redirect()->back()->with('success', 'Todo updated successfully');
}

public function complete(Request $request, $id)
{
    $todo = Todo::findOrFail($id);

    // Toggle the 'completed' field
    $todo->update(['completed' => !$todo->completed]);

    $message = $todo->completed ? 'Task marked as completed!' : 'Task marked as incomplete!';

    return redirect()->back()->with('message', $message);
}

public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return redirect()->route('todos.index')->with('success', 'Todo deleted successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Retrieve the todo item from the database based on the ID
        $todo = Todo::findOrFail($id);

        // Pass the retrieved todo item to the view
        return view('todos.show', compact('todo'));
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
   
}
