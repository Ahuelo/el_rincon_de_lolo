<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticableController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            $token = Auth::user()->createToken('myApp')->plainTextToken;
            return $this->successResponse(['token'=>$token], "se ha iniciado sesión correctamente");
        }
        return $this->errorResponse("No se pudo iniciar sesión");
    }
}
