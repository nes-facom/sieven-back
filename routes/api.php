<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ModalidadeController;
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

//Rotas que não precisam de autenticação
Route::group(['middleware' => 'cors'], function() {
    //Mostra todos os tipos
    Route::get('/tipo', [TipoController::class, 'index']);
    //Mostar todas as categorias
    Route::get('/categoria', [CategoriaController::class, 'index']);
    Route::get('/modalidade', [ModalidadeController::class, 'index']);
    //Mostra todos os eventos
    Route::get('/evento', [EventoController::class, 'index']);
    //Mostra um evento
    Route::get('/evento/{id}', [EventoController::class, 'show']);
    //Mostra todas as atividades de um evento
    Route::get('/evento/{id}/detalhes', [AtividadeController::class, 'showbyEventId']);
    //Mostra uma atividade
    Route::get('/atividade/{id}', [AtividadeController::class, 'show']);
    //Popula Pagina inicial
    Route::get('/eventos-pagina-inicial', [EventoController::class, 'eventosPaginaInicial']);
    //Popula 
     //Rotas de inscrição
     Route::post('/inscricao/criar-inscricao', [InscricaoController::class, 'store']);
});

//Rotas para manipulação do token e login "/api/auth"
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'App\Http\Controllers\AuthController@login')->name('login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh')->name('refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me')->name('me');
});


//Rotas que requerem autenticação
Route::middleware(['jwt.auth'])->group(function () {

    //Atualiza um evento
    Route::put('/evento/{id}', [EventoController::class, 'update']);
    //Deleta um evento
    Route::delete('/evento/{id}', [EventoController::class, 'destroy']);
    //Cadastra um evento
    Route::post('/evento/criar-evento', [EventoController::class, 'store']);


    //Cadastrar uma atividade
    Route::post('/atividade/criar-atividade', [AtividadeController::class, 'store']);
    //Atualiza uma atividade
    Route::put('/atividade/{id}', [AtividadeController::class, 'update']);
    //Deleta uma atividade
    Route::delete('/atividade/{id}', [AtividadeController::class, 'destroy']);
    //Route::get('/atividade/{id}', [AtividadeController::class, 'show']);
    Route::get('/atividade/{id}', [AtividadeController::class, 'showByEventId']);

   


});
    


