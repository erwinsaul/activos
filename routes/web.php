<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivoController;
use App\Http\Controllers\BajaController;

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

Route::get('/', function () {
    return view('welcome');
});

// Rutas para Activo
Route::get('/activos', [ActivoController::class, 'index'])->name('activos.index');
Route::get('/activos/create', [ActivoController::class, 'create'])->name('activos.create');
Route::post('/activos', [ActivoController::class, 'store'])->name('activos.store');
Route::get('/activos/{id}', [ActivoController::class, 'show'])->name('activos.show');
Route::get('/activos/{id}/edit', [ActivoController::class, 'edit'])->name('activos.edit');
Route::put('/activos/{id}', [ActivoController::class, 'update'])->name('activos.update');
Route::delete('/activos/{id}', [ActivoController::class, 'destroy'])->name('activos.destroy');

// Rutas para Baja
Route::get('/bajas', [BajaController::class, 'index'])->name('bajas.index');
Route::get('/bajas/create/{id_activo}', [BajaController::class, 'create'])->name('bajas.create');
Route::post('/bajas', [BajaController::class, 'store'])->name('bajas.store');
Route::get('/bajas/{id}', [BajaController::class, 'show'])->name('bajas.show');
Route::get('/bajas/{id}/edit', [BajaController::class, 'edit'])->name('bajas.edit');
Route::put('/bajas/{id}', [BajaController::class, 'update'])->name('bajas.update');
Route::delete('/bajas/{id}', [BajaController::class, 'destroy'])->name('bajas.destroy');

