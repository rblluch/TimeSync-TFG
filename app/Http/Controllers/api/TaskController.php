<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        /* $user = auth()->user();
        $id = 0;

        if(isset($user->company_id)){
            $id = $user->company_id;
        }else{
            $id = $user->id;
        }

        $tasks = Task::where('company_id', $id)->get(); */
        $tasks = Task::all();
/* 
        if ($tasks->count() > 0) {
            return response()->json([
                'status' => 200,
                'tasks' => $tasks
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'tasks' => 'No hay tasks'
            ], 404);
        } */
        return view('home.home', ['tasks' => $tasks]);

    }

    public function show($id){
        $task = Task::find($id);

        /* if ($task) {
            return response()->json([
                'status' => 200,
                'task' => $task
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'task' => 'Task not found'
            ], 404);
        } */

        if ($task) {
            return view('task.taskShow', ['task' => $task]);
        } else {
            return back()->withErrors([
                'error' => 'Task not found'
            ]);
        } 

    }

    public function store(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'worker_id' => 'required',
            'service_id' => 'required',
            'scheduled_date' => 'required|date',
        ]);

        $user = auth()->user();


        $task = [
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'company_id' => $user->company->id,
            'worker_id' => $request->worker_id,
            'service_id' => $request->service_id,
            'scheduled_date' => $request->scheduled_date,
        ];

        $task = Task::create($task);

        /* return response()->json([
            'status' => 201,
            'message' => 'Task created successfully',
            'task' => $task
        ], 201); */

        return redirect()->route('home');

    }
}
