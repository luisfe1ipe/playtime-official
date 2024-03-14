<?php

use App\Http\Controllers\SocialiteController;
use App\Livewire\Doubts\HowToRegisterANewGame;
use App\Livewire\FindPlayer\FindPlayer;
use App\Livewire\FindPlayer\FormFindPlayer;
use App\Livewire\FindPlayer\SelectGame;
use App\Livewire\News\ListNews;
use App\Livewire\News\ShowNews;
use App\Livewire\Teams\MyTeams\ListMyTeams;
use App\Livewire\Teams\MyTeams\Setting\AboutTeam;
use App\Livewire\Teams\MyTeams\Setting\AppearanceTeam;
use App\Livewire\Teams\MyTeams\ShowMyTeam;
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
Route::get('/encontrar-player/{slug}', FindPlayer::class)->name('find-player.index');
Route::get('/encontrar-player/{slug}/anunciar-vaga', FormFindPlayer::class)->name('find-player.advertise-vacancy');

Route::get('/noticias', ListNews::class)->name('news.list');
Route::get('/noticias/{id}', ShowNews::class)->name('news.show');



Route::get('/times', ListMyTeams::class)->name('my-teams.list');
Route::get('/times/{slug}', ShowMyTeam::class)->name('my-teams.show');
// Apenas lider do time
Route::middleware('auth.team_leader')->group(function () {
  // Rotas que exigem verificação de liderança de equipe
  Route::get('/times/{slug}/configuracoes/sobre', AboutTeam::class)->name('my-teams.settings.about');
  Route::get('/times/{slug}/configuracoes/aparencia', AppearanceTeam::class)->name('my-teams.settings.appearance');
});
