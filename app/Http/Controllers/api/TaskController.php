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
        return view('home', ['tasks' => $tasks]);

    }
}
