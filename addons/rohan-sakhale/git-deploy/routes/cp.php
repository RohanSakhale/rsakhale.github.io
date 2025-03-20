<?php

use Illuminate\Support\Facades\Route;
use RohanSakhale\GitDeploy\Http\Controllers\DeployController;

Route::middleware('statamic.cp.auth')->group(function () {
    Route::get('/git-deploy', [DeployController::class, 'index'])->name('statamic.cp.git-deploy.index');
    Route::post('/git-deploy/push', [DeployController::class, 'commitAndPush'])->name('statamic.cp.git-deploy.push');
});
