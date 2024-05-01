<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function createUser(Request $request){

        try{

            $validate = Validator::make($request->all(), 
            [
                'username' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'repeat_password' => 'required|same:password',
                'role' => 'required',

            ]);
    
            if($validate->fails()){
                return response()->json([
                    'status' => 400,
                    'message' => 'Error to validate data',
                    'errors' => $validate->errors()
                ], 400);
            }
    
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
    
            return response()->json([
                'status' => 201,
                'message' => 'User created successfully',
                'token' => $user->createToken('Sign Up Token')->plainTextToken
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to create user',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function registerCompany(Request $request){

        try{

            $validate = Validator::make($request->all(), 
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'email_confirmation' => 'required|same:email',
                /* 'g-recaptcha-response' => 'required|recaptcha', */
            ]);
    
            if($validate->fails()){
                return response()->json([
                    'status' => 400,
                    'message' => 'Error to validate data',
                    'errors' => $validate->errors()
                ], 400);
            }
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => 5,
            ]);

            //TODO Send Mail
            $token = $user->createToken('Register Token')->plainTextToken;
    
            return response()->json([
                'status' => 201,
                'message' => 'Company created successfully',
                'token' => $token
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to create company',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function login(Request $request){

        try{

            $validate = Validator::make($request->all(), 
            [
                'email' => 'required', //TODO - try to use username or email
                'password' => 'required',
            ]);
    
            if($validate->fails()){
                return response()->json([
                    'status' => 401,
                    'message' => 'Failed to validate data',
                    'errors' => $validate->errors()
                ], 401);
            }

            $email = $request->email;
            $password = $request->password;
    
            if (auth()->attempt(['email' => $email, 'password' => $password])) {
                
                $user = User::where('email', $request->email)->first();
                /* $user = Auth::user(); */

                //TODO - if remember me is checked, create a session with the token
                /* Auth::loginUsingId($user->id);
                session_start(); */

                return response()->json([
                    'status' => 200,
                    'message' => 'User logged successfully',
                    'token' => $user->createToken('Login Token')->accessToken,
                    'user' => $user
                ], 200);

            } else{

                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid credentials',
                ], 401);

            }

            
            
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error login user',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function logout($id){

        $user = User::find($id);

        try{

            $user->tokens()->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Session closed successfully',
            ], 200);
            
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error at close session',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function workday(){
        $user = auth()->user();
        //dd($user);

        if($user){
            $user = User::find($user->id);
            $user->is_working = !$user->is_working;
            $user->save();
        }

        return redirect()->route('home');

    }

    public function sendMail(string $email, string $subject, string $message){
        //TODO - Implement send mail
    }
    
}
