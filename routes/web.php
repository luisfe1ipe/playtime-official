<?php

use App\Http\Controllers\SocialiteController;
use App\Livewire\Doubts\HowToRegisterANewGame;
use App\Livewire\FindPlayer\SelectGame;
use App\Livewire\News\ListNews;
use App\Livewire\News\ShowNews;
use App\Livewire\Teams\MyTeams\ListMyTeams;
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
Route::prefix('/duvidas')->group(function () {
  Route::get('/como-cadastrar-um-novo-jogo', HowToRegisterANewGame::class)->name('doubts.how-to-register-a-new-game');
});


Route::prefix('/auth/google')->group(function () {
  Route::get('/redirect', [SocialiteController::class, 'redirect']);
  Route::get('/callback', [SocialiteController::class, 'callback']);
});


Route::get('/encontrar-player', SelectGame::class)->name('find-player.select-game');

Route::get('/noticias', ListNews::class)->name('news.list');
Route::get('/noticias/{id}', ShowNews::class)->name('news.show');

Route::get('/meus-times', ListMyTeams::class)->name('my-teams.list');
