<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\EvenementsController;
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
    });
});

Route::get('/users/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{user}', [UserController::class, 'update'])->name('users.update');
