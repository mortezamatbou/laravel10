<?php

use App\Http\Controllers\Notes\HomeController;
use App\Http\Controllers\Notes\LoginController;
use App\Http\Controllers\Notes\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| My Test Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('notes.home');
Route::get('/db', [HomeController::class, 'test'])->name('notes.home.test');

Route::get('/login', [LoginController::class, 'login_page'])->name('notes.login');
Route::post('/login', [LoginController::class, 'login'])->name('notes.login.handle');

Route::get('/register', [RegisterController::class, 'register'])->name('notes.register');
Route::post('/register', [RegisterController::class, 'register_handle'])->name('notes.register.handle');

Route::middleware('note.auth')->get('/dashboard', HomeController::class)->name('notes.dashboard');

Route::middleware('note.auth')->prefix('coins')->group(function () {

    Route::get('/', HomeController::class)->name('notes.coins');

    Route::get('/{coin}/write', HomeController::class)->name('notes.coins.write');
    Route::post('/{coin}/write', HomeController::class)->name('notes.coins.write.handle');

    Route::get('/{coin}/trades', HomeController::class)->name('notes.trades');

    Route::get('/{coin}/{note_id}', HomeController::class)->whereNumber(['note_id', 'coin'])->name('notes.trades.detail');

});
