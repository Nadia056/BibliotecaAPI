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
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editorial' => 'required|string|max:255',
            'año' => 'required|string',
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
            'año' => $request->año,
            'genero' => $request->genero,
            'codigo' => $request->codigo,
            'estado' => $request->estado,


        ]);

        $book->save();
       

        return response()->json( 201);
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
            'book_id'=> 'required|integer',
            'cliente_id'=> 'required|integer',
            'fecha_prestamo'=> 'required|date',
            'fecha_devolucion'=> 'nullable|date'

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
            ], 422);
        }
        #si no encuentra el libro 
        $book= Book::find($request->book_id);
        if (!$book) {
            return response()->json('not found book');
        }
        #si no encuentra el cliente donde client_id es el id del cliente
        $client= Usuario::find($request->cliente_id);
        if (!$client) {
            return response()->json('not found client');
        }
        #si el libro esta prestado
        if ($book->estado=='Prestado') {
            return response()->json('el libro ya esta prestado');
        }
        $prestamo= Prestamo::create([
            'book_id'=> $request->book_id,
            'cliente_id'=>$request->cliente_id,
            'fecha_prestamo'=>$request->fecha_prestamo,
            'fecha_devolucion'=>$request->fecha_devolucion
            
        ]);
        $book= Book::find($request->book_id);
        $book->estado='prestado';
        $book->save();
        $prestamo->save();
    }
    public function returnBook(Request $request,$id)
    {
        $prestamo= Prestamo::find($id);
        if (!$prestamo) {
            return response()->json('not found prestamo');
        }
        $prestamo->fecha_devolucion=$request->fecha_devolucion;
        $prestamo->save();
        $book= Book::find($request->book_id);
        $book->estado='Disponible';
        $book->save();
        return response()->json( 201);

    }
    public function getAllPrestamos()
    {
        $prestamo = Prestamo::all();
        return response()->json($prestamo, 200);

    }

    
}


