<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Todo;
use App\Models\Task;
use App\Models\User;
//
//use App\Mail\TodoShared;
//use Illuminate\Support\Facades\Mail;
//
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
          
            return view('todos.index', compact('todos'));
        }
    
        public function create()
        {
            return view('todos.create');   
        }

        public function store(TodoCreateRequest $request)
{
    $data = $request->validated();
    $data['completed'] = 0; 

    $data['user_id'] = auth()->id(); 

    Todo::create($data);

    return redirect()->route('todos.create')->with('success', 'Todo created successfully');
}


public function edit($id)
{
    
    $todo = Todo::findOrFail($id);  
    return view('todos.edit', compact('todo'));
}
    
    

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


    ///
    public function share(Request $request)
    {
        $validatedData = $request->validate([
            'todo_id' => 'required|exists:todos,id',
            'email' => 'required|email|exists:users,email',
            'message' => 'nullable|string',
        ]);
    
        $todo = Todo::findOrFail($validatedData['todo_id']);
        $user = User::where('email', $validatedData['email'])->first();
    
        if (!$todo->users->contains($user)) {
            $todo->users()->attach($user);
            // You may want to send an email notification here using Laravel Mail
            // Example: Mail::to($user->email)->send(new TodoShared($todo, $validatedData['message']));
            
            return response()->json(['message' => 'Todo shared successfully.'], 200);
        } else {
            return response()->json(['message' => 'Todo already shared with this user.'], 400);
        }
    }


}
