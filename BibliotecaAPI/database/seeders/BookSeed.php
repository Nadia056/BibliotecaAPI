<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book = new Book();
        $book->titulo = 'El principito';
        $book->autor = 'Antoine de Saint-Exupéry';
        $book->editorial = 'Salamandra';
        $book->year = '1943-04-06';
        $book->genero = 'Literatura infantil';
        $book->codigo = '978-84-9838-798-1';
        $book->estado = 'Disponible';
        $book->save();

        $book2 = new Book();
        $book2->titulo = 'El señor de los anillos';
        $book2->autor = 'J. R. R. Tolkien';
        $book2->editorial = 'Minotauro';
        $book2->year = '1954-07-29';
        $book2->genero = 'Fantasía';
        $book2->codigo = '978-84-450-7709-1';
        $book2->estado = 'Disponible';
        $book2->save();

        $book3 = new Book();
        $book3->titulo = 'El código Da Vinci';
        $book3->autor = 'Dan Brown';
        $book3->editorial = 'Umbriel';
        $book3->year = '2003-03-18';
        $book3->genero = 'Misterio';
        $book3->codigo = '978-84-95618-69-9';
        $book3->estado = 'Disponible';
        $book3->save();

        $book4 = new Book();
        $book4->titulo = 'El alquimista';
        $book4->autor = 'Paulo Coelho';
        $book4->editorial = 'HarperCollins';
        $book4->year = '1988-01-01';
        $book4->genero = 'Novela';
        $book4->codigo = '978-84-663-4723-7';
        $book4->estado = 'Disponible';
        $book4->save();

        $book5 = new Book();
        $book5->titulo = 'El nombre del viento';
        $book5->autor = 'Patrick Rothfuss';
        $book5->editorial = 'Plaza & Janés';
        $book5->year = '2007-03-27';
        $book5->genero = 'Fantasía';
        $book5->codigo = '978-84-01-33667-0';
        $book5->estado = 'Disponible';
        $book5->save();

        $book6 = new Book();
        $book6->titulo = 'El retrato de Dorian Gray';
        $book6->autor = 'Oscar Wilde';
        $book6->editorial = 'Penguin Clásicos';
        $book6->year = '1890-07-01';
        $book6->genero = 'Novela';
        $book6->codigo = '978-84-9105-120-5';
        $book6->estado = 'Disponible';
        $book6->save();

        $book7 = new Book();
        $book7->titulo = 'El guardián entre el centeno';
        $book7->autor = 'J. D. Salinger';
        $book7->editorial = 'Alianza Editorial';
        $book7->year = '1951-07-16';
        $book7->genero = 'Novela';
        $book7->codigo = '978-84-206-8188-3';
        $book7->estado = 'Disponible';
        $book7->save();
        

    }
}
