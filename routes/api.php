<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\InscricaoController;
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

Route::group(['middleware' => 'cors'], function() {
    //Rotas de Evento
    Route::resource('evento', EventoController::class);
    Route::get('/tipo', [TipoController::class, 'index']);
    Route::get('/categoria', [CategoriaController::class, 'index']);
    Route::get('/evento', [EventoController::class, 'index']);
    Route::post('/evento/criar-evento', [EventoController::class, 'store']);
    Route::get('/evento/{id}', [EventoController::class, 'show']);
    Route::get('/eventos/exibir-eventos', [EventoController::class, 'showAll']);
    Route::put('/evento/{id}', [EventoController::class, 'update']);
    Route::delete('/evento/{id}', [EventoController::class, 'destroy']);

    //Rotas de atividade
    Route::get('/atividade', [AtividadeController::class, 'index']);
    Route::post('/atividade/criar-atividade', [AtividadeController::class, 'store']);
    Route::put('/atividade/{id}', [AtividadeController::class, 'update']);
    Route::delete('/atividade/{id}', [AtividadeController::class, 'destroy']);
    //Route::get('/atividade/{id}', [AtividadeController::class, 'show']);
    Route::get('/atividade/{id}', [AtividadeController::class, 'showByEventId']);

    //Rotas de inscrição
    Route::post('/inscricao/criar-inscricao', [InscricaoController::class, 'store']);


});
