<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Signing;
use App\Models\User;
use App\Models\Schedule;

class TaskController extends Controller
{
    public function index(){
        $user = auth()->user();

        $tasks = Task::where('company_id', $user->company_id)->get();

        return view('home.home', ['tasks' => $tasks]);

    }

    public function taskAll(){
        dd('hola');
        $user = auth()->user();
        $user = User::find($user->id);

        if($user->hasAnyRole(['timesync_admin', 'superadmin'])){
            $tasks = Task::where('company_id', $user->company_id)->get();
        } else{
            $tasks = Task::where('worker_id', $user->id)->get();
        }

        return view('tasks.tasks_all', ['tasks' => $tasks]);
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

        return redirect()->route('home');

    }

    public function showNewTaskForm(){

        $user = auth()->user();
        $services = $user->company->services;

        $workers = $user->company->workers;

        return view('tasks.task_new', ['services' => $services, 'workers' => $workers]);
    }

    public function update(Request $request, $id){
        $task = Task::find($id);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->worker_id = $request->worker;
        $task->service_id = $request->service;
        $task->scheduled_date = $request->scheduled_date;
        $task->save();
        return redirect()->route('home');
    }

    public function updateStatus($id){
        $user = auth()->user();
        $user = User::find($user->id);
        $task = Task::find($id);

        if(!$user->is_working){
            $user->is_working = !$user->is_working;
            $user->save();
            $schedule = Schedule::create([
                'user_id' => $user->id,
                'company_id' => $user->company_id,
                'start_time' => now(),
                'end_time' => null,
            ]);
        }
    
        if($task->status == 'pending'){
            $task->status = 'in_progress';
            $signing = Signing::where('task_id', $task->id)->where('end_date', '!=', null)->first();

            if($signing){ 
                $signing->start_date = now();
                $signing->save();
                //dd('Existe '.$signing);
            } else {
                $signing = Signing::create([
                    'task_id' => $task->id,
                    'user_id' => $task->worker_id,
                    'company_id' => $task->company_id,
                    'start_date' => now(),
                    'end_date' => null,
                ]);
                //dd($signing);
            }

        } else {
            $task->status = 'pending';
            $signing = Signing::where('task_id', $task->id)->first();

            if($signing){
                $signing->end_date = now();
                $signing->save();
            }

            $horaEntrada = Carbon::parse($signing->start_date);
            $horaSalida = Carbon::parse($signing->end_date);
            $diferenciaHoras = ($horaEntrada->diffInSeconds($horaSalida)) / 3600;

            //dd($horaEntrada, $horaSalida, $diferenciaHoras);

            // Almacenar la diferencia de horas como un flotante
            $task->hours += (float) $diferenciaHoras;
            $task->service->hours_used += (float) $diferenciaHoras;
            $task->service->save();

        }
        $task->save();
        return redirect()->back();
    }

    public function delete($id){
        $task = Task::find($id);
        $signing = Signing::where('task_id', $task->id)->first();
        if($signing){
            $signing->delete();
        }
        $task->delete();
        return redirect()->route('home');
    }

    public function cancel($id){
        $task = Task::find($id);
        $signing = Signing::where('task_id', $task->id)->first();
        if($signing){
            $signing->end_date = now();
        }
        $task->status = 'canceled';
        $task->save();
        return redirect()->route('home');
    }

    public function complete($id){
        $task = Task::find($id);
        $signing = Signing::where('task_id', $task->id)->first();
        if($signing){
            $signing->end_date = now();
            $task->status = 'completed';
            $task->save();
        }
        return redirect()->route('home');
    }
}
