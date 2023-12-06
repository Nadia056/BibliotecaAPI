<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $fillable = [
        'id_libro',
        'id_usuario',
        'fecha_prestamo',
        'fecha_devolucion',
    ];
    use HasFactory;
}
