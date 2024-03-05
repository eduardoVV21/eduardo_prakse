<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ShareController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index'); 
    Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create'); 
    Route::post('/todos/create', [TodoController::class, 'store'])->name('todos.store');
    Route::get('/todos/{id}/edit', [TodoController::class, 'edit'])->name('todos.edit');
    Route::put('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
    Route::put('/todos/{id}/complete', [TodoController::class, 'complete'])->name('todos.complete');
    Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
    Route::get('/todos/{id}', [TodoController::class, 'show'])->name('todos.show');

     Route::get('/todos/{todo_id}/tasks/index', [TaskController::class, 'index'])->name('tasks.index');
     Route::get('/todos/{todo_id}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
     Route::post('/todos/{todo_id}/tasks', [TaskController::class, 'store'])->name('tasks.store');
   
      Route::get('/todos/{todo_id}/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
      Route::put('/todos/{todo_id}/tasks/{task_id}', [TaskController::class, 'update'])->name('tasks.update');
      Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
     // Share route
    Route::post('/share/todo', [ShareController::class, 'shareTodo'])->name('share.todo');

    
   
      });

