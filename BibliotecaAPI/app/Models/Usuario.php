<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['nombre', 'email', 'password', 'rol'];
    use HasFactory,HasApiTokens, Notifiable, HasApiTokens;
}
