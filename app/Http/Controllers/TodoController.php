<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();

        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $ids = [];

        foreach ($request->todos as $todo) {

            if (!empty($todo['id'])) {

                $item = Todo::find($todo['id']);

                if ($item) {
                    $item->update([
                        'title' => $todo['title'],
                        'completed' => $todo['completed'],
                    ]);

                    $ids[] = $item->id;
                }

            } else {

                $item = Todo::create([
                    'title' => $todo['title'],
                    'completed' => $todo['completed'],
                ]);

                $ids[] = $item->id;
            }
        }

        Todo::whereNotIn('id', $ids)->delete();

        return 'Saved';
    }

}


