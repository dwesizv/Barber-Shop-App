<?php

use App\Http\Controllers\ImagenController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PeinadoController;
use App\Http\Controllers\ValoracionController;
use Illuminate\Support\Facades\Route;

//logs
Route::get('logs',[\Rap2hpoutre\LaravelLogViewer\LogViewerController::class,'index']);

//main controller
Route::get('/', [MainController::class, 'main'])->name('main');
Route::get('about', [MainController::class, 'about'])->name('about');
Route::get('sql', [MainController::class, 'sql'])->name('sql');
Route::get('inyection', [MainController::class, 'inyection'])->name('inyection');

//imagen controller
Route::get('imagen/{id}', [ImagenController::class, 'imagen'])->name('imagen.imagen');

//peinado controller
Route::resource('peinado', PeinadoController::class);
Route::get('peinado/pelo/{pelo}', [PeinadoController::class, 'pelo'])->name('peinado.pelo');

//valoracion controller
Route::post('valoracion', [ValoracionController::class, 'store'])->name('valoracion.store');
Route::get('valoracion/{valoracion}/edit', [ValoracionController::class, 'edit'])->name('valoracion.edit');
Route::put('valoracion/{valoracion}', [ValoracionController::class, 'update'])->name('valoracion.update');

// Route::get('peinado', [PeinadoController::class, 'index'])->name('peinado.index');
// Route::get('peinado/create', [PeinadoController::class, 'create'])->name('peinado.create');
// Route::post('peinado', [PeinadoController::class, 'store'])->name('peinado.store');
// Route::get('peinado/{peinado}', [PeinadoController::class, 'show'])->name('peinado.show');
// Route::get('peinado/{peinado}/edit', [PeinadoController::class, 'edit'])->name('peinado.edit');
// Route::put('peinado/{peinado}', [PeinadoController::class, 'update'])->name('peinado.update');
// Route::delete('peinado/{peinado}', [PeinadoController::class, 'destroy'])->name('peinado.destroy');
//Route::resource('valoracion', ValoracionController::class);