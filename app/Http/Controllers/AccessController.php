<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Mail\RegistrationConfirmation;
use App\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class AccessController extends Controller
{
    function login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        $email = $request->email;
        $password = $request->password;

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (auth()->attempt($credentials, $remember)) {
            $user = User::where('email', $email)->first();
            //session(['band' => $user]);
            return redirect()->route('home');
        } else {
            return back()->withErrors([
                'error' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout()
    {
        //session()->forget('band');
        auth()->logout();
        return redirect()->route('index');
    }

    public function sendEmail()
    {
        $testEmail = 'rblluch@example.com';
        $testToken = 'testtoken';

        Mail::to($testEmail)->send(new RegistrationConfirmation($testToken));

        return 'Test email sent';
    }

    public function showNewUserForm()
    {
        $roles =  Role::where('name', '!=', 'timesync_admin')
                        ->where('name', '!=', 'superadmin')
                        ->where('name', '!=', 'unregistered_user')
                        ->get();
        return view('users.user_new', ['roles' => $roles]);
    }

    public function store(Request $request){

        //dd($request->all());

        $validate = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password', // 'password' => 'required|confirmed
            'role' => 'required',
        ]);

        //dd($validate);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'roles_id' => $request->role,
            'company_id' => auth()->user()->company_id,
        ]);

        return redirect()->route('home');
    }
}
