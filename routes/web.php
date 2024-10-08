<?php

use App\Http\Controllers\InviteMemberTeamController;
use App\Http\Controllers\SocialiteController;
use App\Livewire\Doubts\HowToRegisterANewGame;
use App\Livewire\Findplayer\EditFindPlayer;
use App\Livewire\FindPlayer\FindPlayer;
use App\Livewire\FindPlayer\FormFindPlayer;
use App\Livewire\FindPlayer\MyFindPlayer;
use App\Livewire\FindPlayer\MyRegistrations;
use App\Livewire\FindPlayer\SelectGame;
use App\Livewire\FindPlayer\ShowFindPlayer;
use App\Livewire\Friends\Chat;
use App\Livewire\Friends\FriendshipRequests;
use App\Livewire\Friends\MyFriends;
use App\Livewire\Home;
use App\Livewire\News\ListNews;
use App\Livewire\News\ShowNews;
use App\Livewire\Notification\ListNotifications;
use App\Livewire\Teams\ListTeams;
use App\Livewire\Teams\MyTeams\ListMyTeams;
use App\Livewire\Teams\MyTeams\Setting\AboutTeam;
use App\Livewire\Teams\MyTeams\Setting\AppearanceTeam;
use App\Livewire\Teams\MyTeams\Setting\MembersTeam;
use App\Livewire\Teams\MyTeams\ShowMyTeam;
use App\Livewire\Test;
use App\Livewire\User\CreateNickname;
use App\Livewire\User\Profile;
use App\Livewire\User\Profile\AddGameProfile;
use App\Livewire\User\Profile\EditGameProfile;
use App\Livewire\User\Profile\EditProfile;
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

Route::get('/', Home::class)->name('home');

Route::get('aceitar-convite-para-o-time/{id}', [InviteMemberTeamController::class, 'accept'])->name('accept-invite');


Route::get('/adicionar-nickname', CreateNickname::class)->name('user.create-nickname');


Route::prefix('/duvidas')->group(function () {
  Route::get('/como-cadastrar-um-novo-jogo', HowToRegisterANewGame::class)->name('doubts.how-to-register-a-new-game');
});


Route::prefix('/auth/google')->group(function () {
  Route::get('/redirect', [SocialiteController::class, 'redirect']);
  Route::get('/callback', [SocialiteController::class, 'callback']);
});


// Route::middleware(['auth', 'checkNickname'])->group(function ()
Route::middleware(['checkNickname'])->group(function () {


  Route::get('/@{nick}', Profile::class)->name('profile');
  Route::get('/@{nick}/editar', EditProfile::class)->name('profile.edit');
  Route::get('/@{nick}/editar/adicionar-jogo', AddGameProfile::class)->name('profile.add-game');
  Route::get('/@{nick}/editar/editar-jogo/{game_user_id}', EditGameProfile::class)->name('profile.edit-game');


  Route::get('/encontrar-player/criadas-por-mim', MyFindPlayer::class)->name('find-player.create-for-my');
  Route::get('/encontrar-player/inscricoes', action: MyRegistrations::class)->name('find-player.my-registrations');

  Route::get('/encontrar-player', SelectGame::class)->name('find-player.select-game');
  Route::get('/encontrar-player/{slug}', FindPlayer::class)->name('find-player.index');
  Route::get('/encontrar-player/{slug}/anunciar-vaga', FormFindPlayer::class)->name('find-player.advertise-vacancy');
  Route::get('/encontrar-player/vaga/{id}', ShowFindPlayer::class)->name('find-player.show');
  Route::get('/encontrar-player/vaga/{id}/editar', EditFindPlayer::class)->name('find-player.edit');

  Route::get('/noticias', ListNews::class)->name('news.list');
  Route::get('/noticias/{id}', ShowNews::class)->name('news.show');




  Route::get('/chat', Chat::class)->name('friends.chat');
  Route::get('/solicitacoes-de-amizade', FriendshipRequests::class)->name('friends.friendship-requests');
  Route::get('/amigos', MyFriends::class)->name('friends.index');



  Route::get('visualizar-minhas-notificacoes', ListNotifications::class)->name('notifications.index');



  Route::get('times', ListTeams::class)->name('teams.index');
  Route::get('/meus-times', ListMyTeams::class)->name('my-teams.list');
  Route::get('/times/{slug}', ShowMyTeam::class)->name('my-teams.show');
  Route::get('/times/{slug}/configuracoes/membros', MembersTeam::class)->name('my-teams.settings.members');


  // Apenas lider do time
  Route::middleware('auth.team_leader')->group(function () {
    // Rotas que exigem verificação de liderança de equipe
    Route::get('/times/{slug}/configuracoes/sobre', AboutTeam::class)->name('my-teams.settings.about');
    Route::get('/times/{slug}/configuracoes/aparencia', AppearanceTeam::class)->name('my-teams.settings.appearance');
  });
});
