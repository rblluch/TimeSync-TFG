<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
                'token' => $user->createToken('API Token')->plainTextToken
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to create user',
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
    
            if(!Auth()->attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid credentials',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => 200,
                'message' => 'User logged successfully',
                'token' => $user->createToken('API Token')->plainTextToken,
                'user' => $user
            ], 200);
            
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
    
}
