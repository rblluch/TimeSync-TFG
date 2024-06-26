<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Task;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return view('index');
    }

    public function home()
    {   
        $user = auth()->user();
        $tasks = Task::with('service')->where('worker_id', $user->id)
                                        ->whereNotIn('status', ['canceled', 'completed'])
                                        ->get();
        return view('home.home', ['tasks' => $tasks]);
    }
}
