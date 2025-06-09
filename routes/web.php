<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VatsimLoginController;

// Группа маршрутов с middleware web (сессии, куки и т.д.)
Route::middleware(['web'])->group(function () {

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

    // Страница аэропорта UNNT
    Route::get('/unnt', [VatsimLoginController::class, 'unnt'])->name('airports.unnt');

    // Профиль текущего пользователя → редирект на /profile/user/{cid}
    Route::get('/profile', function () {
        $userData = session('user_data');
        if (!$userData) {
            return redirect()->route('login');
        }

        $cid = $userData['data']['cid'] ?? null;

        if (!$cid) {
            abort(403, 'CID не найден');
        }

        return redirect()->route('profile.show', ['cid' => $cid]);
    })->name('profile');

    // Профиль произвольного пользователя по CID (только владелец или админ)
    Route::get('/profile/user/{cid}', [VatsimLoginController::class, 'showUserProfile'])->name('profile.show');

    // Главная страница (требует авторизации)
    Route::get('/home', function () {
        if (!session()->has('user_data')) {
            return redirect()->route('login');
        }
        return view('home');
    })->name('home');

    Route::get('/routes', function () {
        $routes = collect(app('router')->getRoutes())->map(function ($route) {
            return [
                'uri' => $route->uri(),
                'methods' => $route->methods(),
                'name' => $route->getName(),
                'action' => $route->getActionName(),
            ];
        });
        return response()->json($routes);
    });

    // Logout
    Route::post('/logout', [VatsimLoginController::class, 'logout'])->name('logout');
});
