<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; // Make sure to import the Task model if you have one

class TaskController extends Controller
{

    public function index($todo_id)
    {
        // Fetch tasks for the specified todo_id
        $tasks = Task::where('todo_id', $todo_id)->get();
        
        // Pass the tasks to the view
        return view('todos.tasks.index', compact('tasks', 'todo_id'));
    }

    public function create($todo_id)
{
    // Pass the todo_id to the view to associate the task with a specific todo
    return view('todos.tasks.create', compact('todo_id'));
}

public function store(Request $request, $todo_id)
{
    $tasks = Task::where('todo_id', $todo_id)->first(); // Get the existing task list

    if ($tasks) {
        $existingTasks = json_decode($tasks->tasks, true); // Get existing tasks as an array

        $newTasks = $request->input('task_name'); // Get the new tasks from the form

        // Append each new task individually to the existing tasks array
        foreach ($newTasks as $taskName) {
            $existingTasks[] = $taskName;
        }

        // Update the existing tasks with the combined tasks
        $tasks->update([
            'tasks' => json_encode($existingTasks),
        ]);
    } else {
        // If there are no existing tasks, create a new task entry
        Task::create([
            'todo_id' => $todo_id,
            'tasks' => json_encode($request->input('task_name')),
        ]);
    }

    return redirect()->route('tasks.index', $todo_id);
}







    public function update(Request $request, $todo_id, $task_id)
    {
        // Your update method logic
    }

    public function destroy($todo_id, $task_id)
    {
        // Your destroy method logic
    }
}
