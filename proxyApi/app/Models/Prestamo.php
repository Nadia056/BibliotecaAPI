<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $fillable = [
        'book_id',
        'cliente_id',
        'fecha_prestamo',
        'fecha_devolucion',
    ];
    use HasFactory;
}
