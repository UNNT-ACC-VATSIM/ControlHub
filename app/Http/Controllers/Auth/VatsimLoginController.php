<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class VatsimLoginController extends Controller
{
    private string $client_id = '1076';
    private string $client_secret = 'A0LJOm3NqIdafK3AHxRQDkYwhjZmexHKpPL6CIsh';
    private string $redirect_uri = 'http://localhost:8000/auth/callback';

    /**
     * Показывает страницу с кнопкой авторизации через VATSIM
     */
public function showLogin()
{
    if (Session::has('user_data')) {
        return redirect()->route('profile');
    }

    $auth_url = 'https://auth-dev.vatsim.net/oauth/authorize?' . http_build_query([
        'client_id'     => $this->client_id,
        'redirect_uri'  => $this->redirect_uri,
        'response_type' => 'code',
        'scope'         => 'full_name email vatsim_details country',
    ]);

    return view('login', compact('auth_url')); // теперь это выполнится
}


    /**
     * Обрабатывает callback от VATSIM с кодом авторизации
     */
    public function handleProviderCallback(Request $request)
    {
        if (!$request->has('code')) {
            return redirect()->route('login')->withErrors(['msg' => 'Код авторизации не получен.']);
        }

        $tokenResponse = Http::asForm()->post('https://auth-dev.vatsim.net/oauth/token', [
            'grant_type'    => 'authorization_code',
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri'  => $this->redirect_uri,
            'code'          => $request->code,
        ]);

        if (!$tokenResponse->successful() || empty($tokenResponse['access_token'])) {
            return redirect()->route('login')->withErrors(['msg' => 'Не удалось получить токен.']);
        }

        $access_token = $tokenResponse['access_token'];

        $userResponse = Http::withToken($access_token)->get('https://auth-dev.vatsim.net/api/user');

        if (!$userResponse->successful()) {
            return redirect()->route('login')->withErrors(['msg' => 'Не удалось получить данные пользователя.']);
        }

        $user_data = $userResponse->json();

        // Сохраняем данные пользователя в сессии
        Session::put('user_data', $user_data);

        return redirect()->route('profile');
    }

    /**
     * Показывает профиль пользователя
     */
    public function profile()
    {
        $user_data = Session::get('user_data');

        if (!$user_data) {
            return redirect()->route('login');
        }

        return view('profile', compact('user_data'));
    }

    /**
     * Выход пользователя и очистка сессии
     */
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::forget('user_data');

        return redirect()->route('login')->with('success', 'Вы успешно вышли из системы.');
    }
}
