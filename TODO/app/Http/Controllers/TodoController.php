<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Todo;
class TodoController extends Controller
{
   
        public function index()
        {
            $todos = Todo::all();
            return view('todos.index', compact('todos'));
        }
    
        public function create()
        {
            return view('todos.create');   //<-Šis nestrādā
        }
    
        public function edit(string $id)
    {
        // Find the todo item by its ID
        //$todo = Todo::findOrFail($id);
        
        // Return the edit view with the todo item data
        return view('todos.edit', compact('todo'));
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
