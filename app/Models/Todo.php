<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{

    protected $fillable = [
        'title',
        'content'
    ];

    public function create($request)
    {
        $this->fill($request->all())->save();
    }

    public function updates($request)
    {
        $todo_id = $request->id;
        $this->find($todo_id)->fill($request->all())->save();
    }

    public function getAllTodo()
    {
        return $this->all();
    }

    public function oneDelete($todo_id)
    {
        $this->find($todo_id)->delete();
    }
}
