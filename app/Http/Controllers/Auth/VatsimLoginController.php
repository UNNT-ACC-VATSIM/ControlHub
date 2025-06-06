<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class VatsimLoginController extends Controller
{
    private $client_id = '1076'; // твой client_id
    private $client_secret = 'A0LJOm3NqIdafK3AHxRQDkYwhjZmexHKpPL6CIsh'; // твой секрет
    private $redirect_uri = 'http://localhost:8000/auth/callback';

    // 1. Перенаправляем на страницу авторизации VATSIM
    public function redirectToProvider()
    {
        $query = http_build_query([
            'client_id' => $this->client_id,
            'redirect_uri' => $this->redirect_uri,
            'response_type' => 'code',
            'scope' => 'full_name email',
        ]);

        return redirect('https://auth-dev.vatsim.net/oauth/authorize?' . $query);
    }

    // 2. Обработка callback от VATSIM с кодом
    public function handleProviderCallback(Request $request)
    {
        if (!$request->has('code')) {
            return redirect()->route('login')->withErrors('Код авторизации не получен.');
        }

        $response = Http::asForm()->post('https://auth-dev.vatsim.net/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri' => $this->redirect_uri,
            'code' => $request->code,
        ]);

        if (!$response->successful() || !isset($response['access_token'])) {
            return redirect()->route('login')->withErrors('Не удалось получить токен.');
        }

        $access_token = $response['access_token'];

        // Получаем данные пользователя
        $user_response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->get('https://auth-dev.vatsim.net/api/user');

        if (!$user_response->successful()) {
            return redirect()->route('login')->withErrors('Не удалось получить данные пользователя.');
        }

        // Сохраняем данные в сессии
        Session::put('user_data', $user_response->json());

        return redirect()->route('profile');
    }

    // 3. Показ профиля пользователя
    public function profile()
    {
        $user_data = Session::get('user_data');

        if (!$user_data) {
            return redirect()->route('login');
        }

        return view('profile', ['user_data' => $user_data]);
    }
}
