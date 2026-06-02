<?php

use App\Http\Controllers\VoteController;
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

Route::view('/', 'index');
Route::view('/success', 'success');
Route::get('/vote', [VoteController::class, 'index']);
Route::post('/vote', [VoteController::class, 'vote']);

Route::get('/result', [VoteController::class, 'result']);