<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return task[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return task::all();
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
                    'todo_id'=>'required',
                ]);
                $todo_id = $request->get('todo_id');
                $name = $request->get('name');
                $task= new task([
                    'todo_id' => $todo_id,
                    'name' => $name
                ]);
                $task->save();

                return ['success'=>'Contact saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return task::where('todo_id', '=', $id)->latest()->get();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return string[]
     */
    public function edit(Request $request, $id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'name'=>'required',
            'todo_id'=>'required',
        ]);

        $task = task::find($id);
        $task->name =  $request->get('name');
        $task->todo_id = $request->get('todo_id');
        $task->completed = $request->get('completed');

        $task->save();
        return ['message'=>'saved'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\task  $task
     * @return string[]
     */
    public function destroy( $id)
    {
        $task = task::find($id);
       $task->delete();
       return ['message'=>'deleted'];
    }
}
