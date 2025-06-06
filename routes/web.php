<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VatsimLoginController;

Route::get('/', function () {
    if (session()->has('user_data')) {
        return redirect()->route('home');
    }
    return redirect()->route('login');
})->name('root');

Route::get('/login', [VatsimLoginController::class, 'redirectToProvider'])->name('login');

Route::get('/auth/callback', [VatsimLoginController::class, 'handleProviderCallback'])->name('vatsim.callback');

Route::get('/profile', [VatsimLoginController::class, 'profile'])->name('profile');

Route::get('/home', function () {
    if (!session()->has('user_data')) {
        return redirect()->route('login');
    }
    return view('home');
})->name('home');

// Logout - очистка сессии и редирект
Route::post('/logout', function () {
    session()->flush();
    return redirect()->route('login');
})->name('logout');
