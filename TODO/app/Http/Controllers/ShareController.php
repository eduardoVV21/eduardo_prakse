<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use App\Models\TodoShare;

class ShareController extends Controller
{
    public function shareTodo(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'nullable|string',
            'todo_id' => 'required|exists:todos,id',
        ]);

        $todo = Todo::findOrFail($request->todo_id);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($todo->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        TodoShare::create([
            'todo_id' => $todo->id,
            'user_id' => $user->id,
            'shared_at' => now(),
            'message' => $request->message,
        ]);

        return response()->json(['message' => 'Todo shared successfully'], 200);
    }
}
