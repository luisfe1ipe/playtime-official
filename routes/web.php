<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Doubts\HowToRegisterANewGame;
use App\Livewire\FindPlayer\SelectGame;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/auth/google/redirect', function () {
  return Socialite::driver('google')->redirect();
});


Route::get('/auth/google/callback', function () {
  $googleUser = Socialite::driver('google')->user();


  $user = User::updateOrCreate([
    'google_id' => $googleUser->getId(),
  ], [
    'name' => $googleUser->getName(),
    'email' => $googleUser->getEmail(),
    'google_token' => $googleUser->token,
    'google_refresh_token' => $googleUser->refreshToken,
    'photo' => $googleUser->getAvatar(),
  ]);

  Auth::login($user);

  return redirect('/encontrar-player');
});
