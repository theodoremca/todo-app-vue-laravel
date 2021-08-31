<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return todo::latest()->get();
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
     * @return string[]
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $name = $request->get('name');
        $task= new todo([
            'name' => $name
        ]);
        $task->save();

        return ['success'=>'Contact saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        return task::where(['todo_id' => $id])->latest();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\todo  $todo
     * @return string[]
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'name'=>'required',
        ]);

        $task = todo::find($id);
        $task->name =  $request->get('name');
        $task->save();
        return ['message'=>'saved'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todo  $todo
     * @return string[]
     */
    public function destroy($id)
    {

        $task = todo::find($id);
        $task->delete();
        return ['message'=>'delete'];
    }
}
