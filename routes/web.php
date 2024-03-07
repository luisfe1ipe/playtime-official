<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Doubts\HowToRegisterANewGame;
use App\Livewire\FindPlayer\SelectGame;
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

Route::get('duvidas-ao-cadastrar-um-novo-jogo', HowToRegisterANewGame::class)->name('doubts.how-to-register-a-new-game');
Route::get('/encontrar-player', SelectGame::class)->name('find-player.select-game');