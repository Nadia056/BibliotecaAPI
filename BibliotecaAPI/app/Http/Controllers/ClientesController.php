<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientesController extends Controller
{
    public function store(Request $request)
    {
        $validator =Usuario ::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255 | unique:clients',
            'password' => 'required|string',

        ]);
        
        if(Usuario::where('email',$request->email)->first()){
            return response()->json(401);
        }
        $client = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => '2',
           
        ]);

        $client->save();
       

        return response()->json( 201);
    }

    public function getAllClientes()
    {
        $clientes = Usuario::get()->toJson(JSON_PRETTY_PRINT);
        return response($clientes, 200);
    }

    public function cliente($id)
    {
    
            $client = Usuario::find($id);
            if (!$client) {
                return response()->json('not found');
            }
            return response()->json($client);
        
    }
   
    
}
