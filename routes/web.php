<?php

use App\Livewire\Consolas\ShowConsolas;
use App\Livewire\Generos\ShowGeneros;
use App\Livewire\Videojuegos\ShowVideojuegos;
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
Route::get('/consolas', ShowConsolas::class)->name('consolas.index');
Route::get('/generos', ShowGeneros::class)->name('generos.index');
