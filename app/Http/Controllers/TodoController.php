<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;


class TodoController extends Controller
{
    private $todo;

    public function __construct(todo $todo)
    {
        $this->middleware('auth');
        $this->todo = $todo;
    }

    public function index()
    {
        return view('index');
    }

    public function all()
    {
        return $this->todo->getAllTodo();
    }

    public function create(Request $request)
    {
        $this->todo->create($request);
        return '作成';
    }

    public function update(Request $request)
    {
        $this->todo->updates($request);
        return 'アプデート';
    }

    public function delete($id)
    {
        $this->todo->oneDelete($id);
        return '削除';
    }
}
