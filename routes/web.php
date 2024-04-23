<?php

use App\Livewire\Consolas\ShowConsolas;
use App\Livewire\Generos\ShowGeneros;
use App\Livewire\Videojuegos\Nintendo\ShowVideojuegosNintendo;
use App\Livewire\Videojuegos\PC\ShowVideojuegosPC;
use App\Livewire\Videojuegos\ShowVideojuegos;
use App\Livewire\Videojuegos\PlayStation\ShowVideojuegosPlayStation;
use App\Livewire\Videojuegos\Xbox\ShowVideojuegosXbox;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

Route::get('/videojuegos', ShowVideojuegos::class)->name('videojuegos.index');
Route::get('/videojuegos/nintendo',ShowVideojuegosNintendo::class)->name('videojuegos.nintendo');
Route::get('/videojuegos/playstation', ShowVideojuegosPlaystation::class)->name('videojuegos.playstation');
Route::get('/videojuegos/xbox', ShowVideojuegosXbox::class)->name('videojuegos.xbox');
Route::get('/videojuegos/pc', ShowVideojuegosPC::class)->name('videojuegos.pc');
Route::get('/consolas', ShowConsolas::class)->name('consolas.index');
Route::get('/generos', ShowGeneros::class)->name('generos.index');
