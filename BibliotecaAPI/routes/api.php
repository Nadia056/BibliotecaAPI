<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("clientes/registro", "App\Http\Controllers\ClientesController@store");
Route::get("clientes", "App\Http\Controllers\ClientesController@getAllClientes");
Route::get("clientes/{id}", "App\Http\Controllers\ClientesController@cliente");



Route::post("libros/registro", "App\Http\Controllers\bookController@register");
Route::get("libros", "App\Http\Controllers\bookController@allBooks");
Route::get("libros/{id}", "App\Http\Controllers\bookController@oneBook");
Route::put("libros/{id}", "App\Http\Controllers\bookController@updateBook");
Route::delete("libros/{id}", "App\Http\Controllers\bookController@deleteBook");

Route::post("prestamos/registro", "App\Http\Controllers\bookController@prestamo");
Route::get("prestamos", "App\Http\Controllers\bookController@getAllPrestamos");
Route::put("prestamos/{id}", "App\Http\Controllers\bookController@updatePrestamo");
Route::delete("prestamos/{id}", "App\Http\Controllers\bookController@deletePrestamo");
Route::get("prestamo/{id}", "App\Http\Controllers\bookController@onePrestamo");

Route::post("devoluciones", "App\Http\Controllers\bookController@returnBook");

Route::post("login", "App\Http\Controllers\LoginController@login");
Route::post("logout", "App\Http\Controllers\LoginController@logout");




