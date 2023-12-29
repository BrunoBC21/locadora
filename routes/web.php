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
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\CancelarController;


Route::get('/cadastrar-veiculo', function(){ return view("veiculos/create");})->middleware('auth')->middleware('admin');
Route::get("/agendar",function(){ return view("veiculos/agendamento");})->middleware('auth');
Route::get("/dias-disponiveis/{id}",function(){ return view("Welcome");})->middleware('auth');


Route::get('/', [CarController::class, 'mostrarCarro'])->middleware('auth');
Route::post("/cadastrar-veiculo", [CarController::class, 'store'])->middleware('auth')->middleware('admin');
Route::get("/dias-disponiveis/{id}", [CarController::class, "diasDisponiveis"])->middleware('auth');
Route::post("/agendamento", [ReserveController::class, "agendamento"])->middleware('auth');
Route::get("/meus-agendamentos", [ReserveController::class, "meusAgendamentos"])->middleware('auth');
Route::post("/cancelar-agendamento", [CancelarController::class, "cancelarAgendamento"])->middleware('auth');
Route::get("/cancelados", [CancelarController::class, "mostrarCancelados"])->middleware('auth');
Route::post("/deletar-veiculo", [CarController::class, 'deletarVeiculo'])->middleware('auth')->middleware('admin');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
