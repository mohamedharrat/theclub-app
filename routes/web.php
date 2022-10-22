<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\EvenementsController;
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
            return view('/home');
        }
    }
})->middleware(['auth', 'verified']);

//ADMIN ROUTE
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    Route::prefix('admin')->group(function () {

        //User route
        Route::resource('users', UserController::class)->except(['edit', 'update']);
        Route::get('/search', [UserController::class, 'search'])->name('users.search');

        Route::resource('evenements', EvenementsController::class)->except(['delete']);
        Route::delete('/evenements/{id}', [EvenementsController::class, 'destroy'])->name('evenements.destroy');
        Route::get('/evenements/{evenement}/edit', [EvenementsController::class, 'edit'])->name('evenements.edit');
        Route::post('/evenements/{evenement}', [EvenementsController::class, 'update'])->name('evenements.update');
    });
});

Route::get('/users/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{user}', [UserController::class, 'update'])->name('users.update');



Route::middleware(['auth'])->group(function () {
    Route::resource('userEvenements', UserEvenementsController::class);
    Route::delete('userEvenements/{userEvenement}', [UserEvenementsController::class, 'destroy'])->name('userEvenements.destroy');
    Route::get('/userEvenements/{id}/participe', [UserEvenementsController::class, 'participe'])->name('userEvenements.participe');
    Route::delete('/userEvenements/{id}/annuler', [UserEvenementsController::class, 'annuler'])->name('userEvenements.annuler');
    Route::get('userEvenements/{userEvenement}/edit', [UserEvenementsController::class, 'edit'])->name('userEvenements.edit');
    Route::post('userEvenements/{userEvenement}', [UserEvenementsController::class, 'update'])->name('userEvenements.update');
});
// Route::get('userEvenements/{userEvenement}/show', [UserEvenementsController::class, 'show'])->name('userEvenements.show');

Route::get('mesEvenements', [UserEvenementsController::class, 'mesEvenements'])->name('mesEvenements')->middleware(['auth', 'verified']);
Route::get('/profil', function () {
    return view('usersView.profil');
})->middleware(['auth', 'verified']);
