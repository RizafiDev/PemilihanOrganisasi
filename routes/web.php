<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/vote', [VoteController::class, 'index'])->name('vote.index');
Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');

Route::resource('dashboard', App\Http\Controllers\DashboardController::class);

Route::resource('kandidat', App\Http\Controllers\KandidatController::class);