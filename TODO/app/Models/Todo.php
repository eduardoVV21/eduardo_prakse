<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

   // protected $guarded=[];
    protected $fillable = ['title', 'completed', 'user_id', 'description'];
 public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'todo_shares', 'todo_id', 'user_id')->withTimestamps();
    // }
   
}
