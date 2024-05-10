<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Mail\RegistrationConfirmation;
use App\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Company;

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
        // Guarda la URL anterior en la sesión
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


        return redirect()->route('users');
    }

    public function register(Request $request){

        //dd($request->all());

        $validate = request()->validate([
            'name' => 'required|unique:company',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password', // 'password' => 'required|confirmed
            'g-recaptcha-response' => 'required',
        ]);

        //dd($validate);
        $company = Company::create([
            'name' => $request->name,
        ]);
        //dd($company);
        $user = User::create([
            'name' => $request->name.'_admin',
            'email' => $request->email,
            'password' => $request->password,
            'roles_id' => '2',
            'company_id' => $company->id,
            'is_working' => '0',
        ]);
        //dd($user);


        return redirect()->route('users');
    }
}
