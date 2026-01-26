<?php

use App\Http\Controllers\ApiPeinadoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::apiResource('peinado', ApiPeinadoController::class)->names('apipeinado');
Route::get('guzzle/{id?}', [ApiPeinadoController::class, 'guzzle'])->name('apipeinado.guzzle');