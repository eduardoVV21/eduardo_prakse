<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;

class ShareController extends Controller
{
    public function shareTodo(Request $request)
    {
        // Validējiet ienākošos datus
        $validatedData = $request->validate([
            'todo_id' => 'required|exists:todos,id',
            'email' => 'required|email',
            'message' => 'nullable|string',
        ]);

        // Atrodiet uzdevumu, ko vēlaties kopīgot
        $todo = Todo::findOrFail($validatedData['todo_id']);

        // Atrodiet lietotāju, kuram vēlaties kopīgot
        $user = User::where('email', $validatedData['email'])->first();

        // Ja lietotājs nav atrasts, varat izvēlēties, kā rīkoties
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Pievienojiet uzdevumu lietotājam
        $user->todos()->attach($todo);

        // Šeit jūs varat nosūtīt e-pastu, ja vēlaties
        // Mail::to($user)->send(new TodoShared($todo, $validatedData['message']));

        return redirect()->back()->with('success', 'Todo shared successfully.');
    }
}
