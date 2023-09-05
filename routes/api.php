<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\CategoriaController;
use Database\Seeders\CategoriaSeeder;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
header('Access-Control-Allow-Origin: *');

Route::resource('evento', EventoController::class);
Route::get('/tipo', [TipoController::class, 'index']);
Route::get('/categoria', [CategoriaController::class, 'index']);
Route::get('/evento', [EventoController::class, 'index']);
Route::post('/evento/criar-evento', [EventoController::class, 'create']);
Route::get('/evento/{id}', [EventoController::class, 'show']);
Route::get('/eventos/exibir-eventos', [EventoController::class, 'showAll']);
// Route::post('/eventos', [EventoController::class, 'store']);
// Route::put('/eventos/{id}', [EventoController::class, 'update']);
// Route::delete('/eventos/{id}', [EventoController::class, 'destroy']);

