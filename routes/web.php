<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ParticipacaoController;
use App\Mail\newLaravelTips;

use function Psy\debug;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::get('/eventos', [EventoController::class, 'index']);
// Route::get('/eventos/{id}', [EventoController::class, 'show']);
// Route::post('/eventos', [EventoController::class, 'store']);
// Route::put('/eventos/{id}', [EventoController::class, 'update']);
// Route::delete('/eventos/{id}', [EventoController::class, 'destroy']);


Route::get('/atividades', [AtividadeController::class, 'index']);
Route::get('/atividades/{id}', [AtividadeController::class, 'show']);
Route::get('/atividades/evento/{eventoId}', [AtividadeController::class, 'showByEventId']);

Route::post('/atividades', [AtividadeController::class, 'store']);
Route::put('/atividades/{id}', [AtividadeController::class, 'update']);
Route::delete('/atividades/{id}', [AtividadeController::class, 'destroy']);

header('Access-Control-Allow-Origin: *');

require __DIR__.'/auth.php';
