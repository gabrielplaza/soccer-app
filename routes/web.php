<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/players');
});

Route::get('/players', [PlayerController::class, 'index'])->name('players.index');;
Route::post('/players', [PlayerController::class, 'store'])->name('players.store');
Route::put('/players/confirm/{id}', [PlayerController::class, 'confirm'])->name('players.confirm');
Route::put('/players/{id}', [PlayerController::class, 'update'])->name('players.update');
Route::get('/players/create', [PlayerController::class, 'create'])->name('players.create');
Route::get('/draw-teams', [PlayerController::class, 'drawTeams'])->name('draw-teams');
Route::get('/players/{id}/edit', [PlayerController::class, 'edit'])->name('players.edit');
Route::delete('/players/{id}', [PlayerController::class, 'destroy'])->name('players.destroy');



