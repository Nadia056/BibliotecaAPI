<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'titulo',
        'autor',
        'editorial',
        'year',
        'genero',
        'codigo',
        'estado'
    ];

    use HasFactory;
}
