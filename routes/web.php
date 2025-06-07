<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VatsimLoginController;

// Главная: редирект в зависимости от сессии
Route::get('/', function () {
    return session()->has('user_data')
        ? redirect()->route('home')
        : redirect()->route('login');
})->name('root');

// Страница логина
Route::get('/login', [VatsimLoginController::class, 'showLogin'])->name('login');

// Callback от VATSIM OAuth
Route::get('/auth/callback', [VatsimLoginController::class, 'handleProviderCallback'])->name('vatsim.callback');

// Профиль пользователя (требует авторизации)
Route::get('/unnt', [VatsimLoginController::class, 'unnt'])->name('airports.unnt');


// Профиль пользователя (требует авторизации)
Route::get('/profile', [VatsimLoginController::class, 'profile'])->name('profile');

// Главная (домашняя) страница (требует авторизации)
Route::get('/home', function () {
    if (!session()->has('user_data')) {
        return redirect()->route('login');
    }

    return view('home');
})->name('home');

// Logout
Route::post('/logout', [VatsimLoginController::class, 'logout'])->name('logout');
