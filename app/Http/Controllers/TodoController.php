<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\TodoRequest;
use DB;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($term = null)
    {
        if($term != null)
        {
            $tasks['data'] = Todo::where('name', 'like', "%{$term}%")->get();
            return request()->json(200,$tasks);                 

        }
        $tasks = Todo::orderBy('id','desc')->paginate(3);
        return request()->json(200,$tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        $task = Todo::create([
            'name'=>$request->name,
        ]);

        if($task)
        {
            $tasks = Todo::orderBy('id','desc')->paginate(3);
            return request()->json(200,$tasks);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $task)
    {
        return request()->json(200,$task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(TodoRequest $request, Todo $task)
    {
        $task = Todo::find($task->id)->update([
            'name'=>$request->name,
        ]);

        if($task)
        {
            $tasks = Todo::orderBy('id','desc')->paginate(3);
            return request()->json(200,$tasks);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $task)
    {
        $deleted = DB::delete('delete from todos where id = ?',[$task->id]);
        if($deleted)
        {
            $tasks = Todo::orderBy('id','desc')->paginate(3);
            return request()->json(200,$tasks);
        }
        else
        {
             return request()->json(200,['delete'=>'Error deleting record']);
        }
    }
}
