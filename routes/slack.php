<?php

use App\Http\Controllers\FcmController;
use App\Http\Controllers\SlackController;
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

Route::get('/', [SlackController::class, 'index'])->name('slack.index');
Route::get('/hook', [SlackController::class, 'hook'])->name('slack.hook');
