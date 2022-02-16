<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Models\Todo;
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
        //
        $all = Todo::orderBy('id', 'DESC')->get();
        $act = Todo::orderBy('id', 'DESC')->where('isDone', 0)->get();
        $done = Todo::orderBy('id', 'DESC')->where('isDone', 1)->get();

        return view('todo/index',compact('all', 'act', 'done'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function done($id)
    {
        //
        $todo = Todo::where('id',$id)->first();

        $todo->update([
			'isDone' => 1
		]);
        
		return redirect('todo')->with('status', 'Task Completed!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoRequest $request)
    {
        //
        Todo::create([
			'name' => $request->name,
			'isDone' => 0
		]);
        
		return redirect('todo')->with('status', 'Task created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $todo = Todo::where('id',$id)->get();
        
        return view('todo.edit',compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTodoRequest $request, $id)
    {
        //
        $todo = Todo::where('id',$id)->first();

        $todo->update([
			'name' => $request->name,
			'isDone' => $request->status
		]);
        
		return redirect('todo')->with('status', 'Task updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $todo = Todo::findOrFail($id);
        $todo->delete();
        
        return redirect('todo')->with('status', 'Task deleted!');
    }
}
