<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AideAdminController;
use App\Http\Controllers\EvenementsController;
use App\Http\Controllers\ReponseController;
use App\Http\Controllers\UserEvenementsController;
use App\Models\UserEvenement;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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
    return view('admin.dashboard');
})->middleware(['auth', 'admin']);

// Route::get('/adminHome', function () {
//     return view('adminHome');
// })->middleware('auth');



Route::get('/home', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 'admin') {
            return view('adminHome');
        } else {
            return redirect('userEvenements');
        }
    }
})->middleware(['auth', 'verified']);

//ADMIN ROUTE
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    Route::prefix('admin')->group(function () {

        //User route
        Route::resource('users', UserController::class)->except(['edit', 'update']);
        Route::get('/search', [UserController::class, 'search'])->name('users.search');

        Route::get('/users/{user}', [UserController::class, 'edit'])->name('users.edit')->middleware(['admin', 'verified']);;
        Route::post('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware(['admin', 'verified']);;

        Route::resource('evenements', EvenementsController::class)->except(['delete']);
        Route::get('/evenements/{id}/ajoutPlayer', [EvenementsController::class, 'ajoutPlayer'])->name('evenements.ajoutPlayer');
        Route::delete('userEvenements/{id}/adminDeletePlayers', [EvenementsController::class, 'adminDeletePlayers'])->name('evenements.adminDeletePlayers');
        Route::get('/searchEvenements', [EvenementsController::class, 'search'])->name('evenements.search');
        Route::delete('/evenements/{id}', [EvenementsController::class, 'destroy'])->name('evenements.destroy');
        Route::get('/evenements/{evenement}/edit', [EvenementsController::class, 'edit'])->name('evenements.edit');
        Route::post('/evenements/{evenement}', [EvenementsController::class, 'update'])->name('evenements.update');
    });
});




Route::middleware(['auth'])->group(function () {
    Route::resource('userEvenements', UserEvenementsController::class);
    Route::delete('userEvenements/{userEvenement}', [UserEvenementsController::class, 'destroy'])->name('userEvenements.destroy');
    Route::get('/userEvenements/{id}/participe', [UserEvenementsController::class, 'participe'])->name('userEvenements.participe');
    Route::get('userEvenements/{id}/like', [UserEvenementsController::class, 'like'])->name('userEvenements.like');
    Route::delete('/userEvenements/{id}/annuler', [UserEvenementsController::class, 'annuler'])->name('userEvenements.annuler');
    Route::delete('userEvenements/{id}/deletePlayers', [UserEvenementsController::class, 'deletePlayers'])->name('userEvenements.deletePlayers');
    Route::get('userEvenements/{userEvenement}/edit', [UserEvenementsController::class, 'edit'])->name('userEvenements.edit');
    Route::post('userEvenements/{userEvenement}', [UserEvenementsController::class, 'update'])->name('userEvenements.update');
});
// Route::get('userEvenements/{userEvenement}/show', [UserEvenementsController::class, 'show'])->name('userEvenements.show');

Route::get('mesEvenements', [UserEvenementsController::class, 'mesEvenements'])->name('mesEvenements')->middleware(['auth', 'verified']);
Route::get('favoris', [UserEvenementsController::class, 'favoris'])->name('favoris')->middleware(['auth', 'verified']);
Route::get('/profil', function () {
    return view('usersView.profil');
})->middleware(['auth', 'verified']);
Route::get('editProfil/{user}', [UserEvenementsController::class, 'editProfil'])->name('editProfil')->middleware(['auth', 'verified']);
Route::post('updateProfil/{user}', [UserEvenementsController::class, 'updateProfil'])->name('updateProfil')->middleware(['auth', 'verified']);


Route::middleware(['auth'])->group(function () {
    Route::resource('aideAdmin', AideAdminController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('reponse', ReponseController::class);
});
