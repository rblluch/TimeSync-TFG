<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $user = auth()->user();
        $id = 0;

        /* if(isset($user->company_id)){
            $id = $user->company_id;
        }else{
            $id = $user->id;
        } */

        $tasks = Task::where('company_id', $user->company_id)->get();
        //$tasks = Task::all();
        
        /* if ($tasks->count() > 0) {
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

        if ($task) {
            return view('tasks.task_show', ['task' => $task]);
        } else {
            return back()->withErrors([
                'error' => 'Task not found'
            ]);
        } 

    }

    public function store(Request $request){
        //dd($request->all());
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'worker' => 'required',
            'service' => 'required',
            'scheduled_date' => 'required',
        ]);

        /* dd($validate); */
        //dd($request->all());

        if(!$validate){
            return back()->withErrors([
                'error' => 'Error al validar los datos',
            ]);
        }

        $user = auth()->user();



        $task = [
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'pending',
            'company_id' => $user->company->id,
            'worker_id' => $request->worker,
            'service_id' => $request->service,
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

    public function showNewTaskForm(){

        $user = auth()->user();
        $services = $user->company->services;

        $workers = $user->company->workers;

        return view('tasks.task_new', ['services' => $services, 'workers' => $workers]);
    }
}
