<?php

use App\Http\Controllers\GitController;
use Illuminate\Support\Facades\Route;

Route::post('/cp/git-commit', [GitController::class, 'commitAndPush'])
    ->middleware('auth')
    ->name('git.commit');


Route::get('/cp/git-commit-ui', function () {
    return view('git_commit');
})->name('statamic.git')->middleware('auth');

Route::get('/cp/dashboard', function () {
    return view('dashboard'); // Show custom dashboard with Git Commit button
})->middleware('auth');
