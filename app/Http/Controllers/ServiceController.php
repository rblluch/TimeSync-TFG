<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        return view('service.index');
    }

    public function showNewServiceForm()
    {
        return view('services.service_new');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'total_hours' => 'numeric',
        ]);

        $user = auth()->user();

        $service = Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'total_hours' => $request->total_hours,
            'company_id' => $user->company_id,
        ]);

        return redirect()->route('home');


    }
}
