<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Mail\RegistrationConfirmation;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class AccessController extends Controller
{
    /* public function login(Request $request){
        try{

            $response = Http::get(env('API_ENDPOINT').'hola');

            if ($response->ok()) {
                // Obtener los datos de la respuesta en formato JSON
                $data = $response->json();
    
                // Pasar los datos a la vista
                return view('welcome');
            } else {
                // Manejar errores de la solicitud
                return view('welcome');

            }

        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to login',
                'error' => $e->getMessage()
            ], 500);
        }
    } */
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
}
