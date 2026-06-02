<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VotingController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (English)
|--------------------------------------------------------------------------
*/

Route::get('/', [VoteController::class, 'index'])->name('home');
Route::get('/vote', [VoteController::class, 'vote'])->name('vote');
Route::post('/vote', [VoteController::class, 'submitVote'])->name('vote.submit');
Route::get('/success', [VoteController::class, 'success'])->name('vote.success');
Route::get('/result', [VoteController::class, 'result'])->name('result');
Route::post('/result/check', [VoteController::class, 'checkKeyword'])->name('result.check');

/*
|--------------------------------------------------------------------------
| Admin Routes (Indonesian)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    // Auth (guest only)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    });

    // Protected routes
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Candidate management
        Route::post('/candidates/reset', [CandidateController::class, 'reset'])->name('admin.candidates.reset');
        Route::resource('candidates', CandidateController::class)->names([
            'index' => 'admin.candidates.index',
            'create' => 'admin.candidates.create',
            'store' => 'admin.candidates.store',
            'edit' => 'admin.candidates.edit',
            'update' => 'admin.candidates.update',
            'destroy' => 'admin.candidates.destroy',
        ])->except(['show']);

        // Voting status control
        Route::post('/voting/status', [VotingController::class, 'updateStatus'])->name('admin.voting.status');
        Route::post('/voting/reset', [VotingController::class, 'resetVotes'])->name('admin.voting.reset');
    });
});
