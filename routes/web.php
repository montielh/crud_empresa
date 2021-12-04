<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\NotaventaController;
use App\Http\Controllers\EmpresaController;


Route::get('/', function () {
    return view('index');
});

//Rutas cliente
Route::get('/cliente', [ClienteController::class, 'listar']);
Route::post('/cliente/guardar', [ClienteController::class, 'guardar']);
Route::put('/cliente/modificar', [ClienteController::class, 'modificar']);
Route::delete('/cliente/eliminar/{id}', [ClienteController::class, 'eliminar']);



//Rutas categoria
Route::get('/categoria', [CategoriaController::class, 'listar']);
Route::post('/categoria/guardar', [CategoriaController::class, 'guardar']);
Route::put('/categoria/modificar', [CategoriaController::class, 'modificar']);
Route::delete('/categoria/eliminar/{id}', [CategoriaController::class, 'eliminar']);
Route::get('/categorias/selectCategoria', [CategoriaController::class, 'selectCategoria']);


//Rutas Producto
Route::get('/producto', [ProductoController::class, 'listar']);
Route::post('/producto/guardar', [ProductoController::class, 'guardar']);
Route::put('/producto/modificar', [ProductoController::class, 'modificar']);
Route::delete('/producto/eliminar/{id}', [ProductoController::class, 'eliminar']);


//Rutas Notaventa
Route::get('/notaventa', [NotaventaController::class, 'listar']);
Route::post('/notaventa/guardar', [NotaventaController::class, 'guardar']);
Route::put('/notaventa/modificar', [NotaventaController::class, 'modificar']);
Route::get('/notaventa/notaventas', [NotaventaController::class, 'listar']);

//Rutas empresa
Route::get('/empresa', [EmpresaController::class, 'listar']);
Route::post('/empresa/guardar', [EmpresaController::class, 'guardar']);
Route::put('/empresa/modificar', [EmpresaController::class, 'modificar']);
Route::delete('/empresa/eliminar/{id}', [EmpresaController::class, 'eliminar']);