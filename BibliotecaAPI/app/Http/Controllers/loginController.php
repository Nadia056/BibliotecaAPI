<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function login(Request $request)
    {
        $user = Usuario::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Invalid credentials'
            ],400);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'id'=>$user->id,    
        ],200
);
       
    }
    public function logout(Request $request)

    {
       
        if (Auth::check()) {
            $request->user()->currentAccessToken()->delete();
        }
        return response()->json(['message' => 'Successfully logged out']);
    }

}
