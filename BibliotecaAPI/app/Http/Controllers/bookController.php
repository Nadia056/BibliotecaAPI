<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Prestamo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class bookController extends Controller
{
    protected function WS($event, $data)
    {
        $response = [
            'event' => $event,
            'data' => $data
        ];

        event(new \App\Events\MessageEvent(json_encode($response)));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editorial' => 'required|string|max:255',
            'year' => 'required|string',
            'genero' => 'required|string|max:255',
            'codigo' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        if(Book::where('titulo',$request->titulo)->first()){
            return response()->json(401);
        }
        $book = Book::create([
            'titulo' => $request->titulo,
            'autor' => $request->autor,
            'editorial' => $request->editorial,
            'year' => $request->year,
            'genero' => $request->genero,
            'codigo' => $request->codigo,
            'estado' => $request->estado,


        ]);

        $book->save();
        $this->WS('new-book', $book);
        return response()->json( 200);
    }
    
    public function deleteBook($id)
    {
        $book= Book::find($id);
        if (!$book) {
            return response()->json('not found');
        }
        $book->delete();
        return response()->json( 201);
    }

    public function allBooks()
    {
        $book = Book::all();
        return response()->json($book, 200);

    }
    public function updateBook(Request $request,$id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json('not found');
        }
        $book->update($request->all());
        return response()->json($book, 200);
        
    }
    public function oneBook($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json('not found');
        }
        return response()->json($book);
    }



    public function prestamo(Request $request)
    {
        $validator= Validator::make($request->all(),
        [
            'id_usuario'=> 'required|integer',
            'id_libro'=> 'required|integer',
            'fecha_prestamo'=> 'required|string',
            'fecha_devolucion'=> 'nullable|string'

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
            ], 422);
        }
        #si no encuentra el libro 
        $book= Book::find($request->id_libro);
        if (!$book) {
            return response()->json('not found book');
        }
        #si no encuentra el cliente donde client_id es el id del cliente
        $client= Usuario::find($request->id_usuario);
        if (!$client) {
            return response()->json('not found client');
        }
        #si el libro esta prestado
        if ($book->estado=='Prestado') {
            return response()->json('el libro ya esta prestado');
        }
        $prestamo= Prestamo::create([
            'id_usuario'=> $request->id_usuario,
            'id_libro'=>$request->id_libro,
            'fecha_prestamo'=>$request->fecha_prestamo,
            'fecha_devolucion'=>$request->fecha_devolucion
            
        ]);
        $book= Book::find($request->id_libro);
        $book->estado='prestado';
        $book->save();
        $prestamo->save();
        return response()->json( 200);
    }
    public function returnBook(Request $request,$id)
    {
        $prestamo= Prestamo::find($id);
        if (!$prestamo) {
            return response()->json('not found prestamo');
        }
        $prestamo->fecha_devolucion=$request->fecha_devolucion;
        $prestamo->save();
        $book= Book::find($request->id_libro);
        $book->estado='Disponible';
        $book->save();
        return response()->json( 201);

    }
    public function getAllPrestamos()
    {
        $prestamos = Prestamo::all();
    
        foreach ($prestamos as $prestamo) {
            $book = Book::find($prestamo->id_libro);
            $prestamo->libro = $book ? $book->titulo : null;
    
            $client = Usuario::find($prestamo->id_usuario);
            $prestamo->cliente = $client ? $client->nombre : null;
        }

        $this->WS('new-prestamo', $prestamos);
    
        return response()->json($prestamos, 200);
    }
    public function updatePrestamo(Request $request,$id)
    {
        $prestamo = Prestamo::find($id);
        if (!$prestamo) {
            return response()->json('not found');
        }
        $prestamo->update($request->all());
        return response()->json($prestamo, 200);
        
    }
    public function deletePrestamo($id)
    {
        $prestamo= Prestamo::find($id);
        if (!$prestamo) {
            return response()->json('not found');
        }
        $prestamo->delete();
        return response()->json( 201);
    }
    
    public function onePrestamo($id)
    {
       //buscar los prestamos del cliente por id
        $prestamos = Prestamo::where('id_usuario', $id)->get();
        //si no encuentra el cliente
        if (!$prestamos) {
            return response()->json('not found');
        }
        //si encuentra el cliente
        foreach ($prestamos as $prestamo) {
            $book = Book::find($prestamo->id_libro);
            $prestamo->libro = $book ? $book->titulo : null;
    
            $client = Usuario::find($prestamo->id_usuario);
            $prestamo->cliente = $client ? $client->nombre : null;
        }

       
        return response()->json($prestamos, 200);
    }


}


