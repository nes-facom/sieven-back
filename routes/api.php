<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AuthController;

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
    Route::get('/eventos/exibir-eventos', [EventoController::class, 'showAll']);
    Route::get('/atividade/{id}', [AtividadeController::class, 'show']);
    Route::get('/atividade', [AtividadeController::class, 'index']);
    
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'App\Http\Controllers\AuthController@login')->name('login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh')->name('refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me')->name('me');
});

Route::middleware(['jwt.auth'])->group(function () {

    //Rotas de evento
    Route::put('/evento/{id}', [EventoController::class, 'update']);
    Route::delete('/evento/{id}', [EventoController::class, 'destroy']);
    Route::post('/evento/criar-evento', [EventoController::class, 'store']);
    Route::get('/evento/{id}', [EventoController::class, 'show']);

    //Rotas de atividade
    // Route::get('/atividade', [AtividadeController::class, 'index']);
    Route::post('/atividade/criar-atividade', [AtividadeController::class, 'store']);
    Route::put('/atividade/{id}', [AtividadeController::class, 'update']);
    Route::delete('/atividade/{id}', [AtividadeController::class, 'destroy']);
    //Route::get('/atividade/{id}', [AtividadeController::class, 'show']);
    // Route::get('/atividade/{id}', [AtividadeController::class, 'showByEventId']);

});
    


