<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VatsimLoginController;

Route::get('/', [VatsimLoginController::class, 'redirectToProvider'])->name('login');

Route::get('/auth/callback', [VatsimLoginController::class, 'handleProviderCallback'])->name('vatsim.callback');

Route::get('/profile', [VatsimLoginController::class, 'profile'])->name('profile');
