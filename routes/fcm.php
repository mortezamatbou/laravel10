<?php

use App\Http\Controllers\FcmController;
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

Route::get('/', [FcmController::class, 'index'])->name('fcm.index');
Route::get('/push', [FcmController::class, 'push_form'])->name('fcm.push_form');
Route::post('/push', [FcmController::class, 'push'])->name('fcm.push');
