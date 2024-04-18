<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AccessController extends Controller
{
    public function login(Request $request){
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
    }
}
