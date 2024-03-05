<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use Illuminate\Http\Request;
use App\Models\Task; 

class TaskController extends Controller
{

    public function index($todo_id)
    {
       
        $tasks = Task::where('todo_id', $todo_id)->get();
        
        // Pass the tasks to the view
        return view('todos.tasks.index', compact('tasks', 'todo_id'));
    }

    public function create($todo_id)
    
{
    // Pass the todo_id to the view to associate the task with a specific todo
    return view('todos.tasks.create', compact('todo_id'));
}

// public function store(Request $request, $todo_id)
// {
//     // Validate the incoming request data
//     $validatedData = $request->validate([
//         'task_name.*' => 'required|string',
//     ]);

//     // Retrieve the tasks from the request
//     $task_names = $validatedData['task_name'];

//     // Retrieve the todo corresponding to the provided todo_id
//     $todo = Todo::findOrFail($todo_id);

//     // Loop through each task name and create a new task instance
//     foreach ($task_names as $task_name) {
//         $task = new Task();
//         $task->todo_id = $todo_id;
//         $task->name = $task_name;
//         $task->save();
//     }

//     // Redirect back to the index page with a success message
//     return redirect()->route('tasks.index', $todo_id)->with('message', 'Tasks created successfully!');
// }


public function store(Request $request, $todo_id)
{
    $tasks = Task::where('todo_id', $todo_id)->first(); 

    if ($tasks) {
        $existingTasks = json_decode($tasks->tasks, true); 
        $newTasks = $request->input('task_name'); 

        
        foreach ($newTasks as $taskName) {
            $existingTasks[] = $taskName;
        }

      
        $tasks->update([
            'tasks' => json_encode($existingTasks),
        ]);
    } else {
       
        Task::create([
            'todo_id' => $todo_id,
            'tasks' => json_encode($request->input('task_name')),
        ]);
    }

    return redirect()->route('tasks.index', $todo_id);
}

public function edit($todo_id, $task_id)
{
    
    $task = Task::where('todo_id', $todo_id)->where('id', $task_id)->first();


    if (!$task) {
        
        abort(404);
    }

    return view('todos.tasks.edit', compact('todo_id', 'task'));
}

public function update(Request $request, $todo_id, $task_id)
{
    
    $validatedData = $request->validate([
        'task_data.*' => 'required|string', 
    ]);

   
    $task = Task::findOrFail($task_id);

   
    $task->tasks = json_encode($request->task_data);
    $task->save();

    
    return redirect()->route('tasks.index', ['todo_id' => $todo_id])->with('success', 'Task updated successfully.');
}

public function destroy($todo_id)
{
   
    $taskIndex = request()->input('task_index');

    
    $task = Task::where('todo_id', $todo_id)->first();

    
    $tasks = json_decode($task->tasks);

   
    if(isset($tasks[$taskIndex])) {
        
        array_splice($tasks, $taskIndex, 1);

        
        $task->tasks = json_encode($tasks);
        $task->save();

        
        return redirect()->back()->with('success', 'Task deleted successfully.');
    } else {
       
        return redirect()->back()->with('error', 'Invalid task index.');
    }
}
////////////////////
}
