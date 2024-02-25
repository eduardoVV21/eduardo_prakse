<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
         // Check if the user with the given email already exists
        // if (User::where('email', 'sarthak@bitfumes.com')->exists()) {
       //     return "User with email 'sarthak@bitfumes.com' already exists.";
       // }

      //  $user = new User();  
     //   $user->name = 'sarthak';
      //  $user->email = 'sarthak@bitfumes.com';
       // $user->password = 'password';
      //  $user->save();
        //DB::insert('insert into users (name,email,password)
      //  values (?,?,?)',[
       //    'sarthak', 'sarthak@bitfumes.com', 'password',
      // ]);

      //$users = DB::select('select * from users');
     // return $users;

    // DB::update('update users set name = ? where id = 1',
    // ['bitfumes']);

   // DB::detete('delete from users where id = 1');

     //$users = DB::select('select * from users');
     //return $users;

        return view('home');
    }
}
