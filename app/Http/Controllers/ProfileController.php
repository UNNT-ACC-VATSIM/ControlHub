<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    private string $client_id = '1076';
    private string $client_secret = 'Твой_секрет';

    public function index(Request $request)
    {
        if ($request->has('code')) {
            $code = $request->get('code');
            $redirect_uri = route('profile');

            $tokenResponse = Http::asForm()->post('https://auth-dev.vatsim.net/oauth/token', [
                'grant_type' => 'authorization_code',
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'redirect_uri' => $redirect_uri,
                'code' => $code,
            ]);

            if (!$tokenResponse->successful() || !isset($tokenResponse['access_token'])) {
                abort(500, 'Ошибка получения токена');
            }

            $access_token = $tokenResponse['access_token'];

            $userInfoResponse = Http::withToken($access_token)->get('https://auth-dev.vatsim.net/api/user');

            if (!$userInfoResponse->successful()) {
                abort(500, 'Ошибка получения данных пользователя');
            }

            $userData = $userInfoResponse->json();

            // Сохраняем в сессию и user_data и access_token
            Session::put('user_data', $userData);
            Session::put('access_token', $access_token);

            return redirect()->route('home');
        }

        if (!Session::has('user_data')) {
            $authUrl = 'https://auth-dev.vatsim.net/oauth/authorize?' . http_build_query([
                'client_id' => $this->client_id,
                'redirect_uri' => route('home'),
                'response_type' => 'code',
                'scope' => 'full_name email',
            ]);
            return view('login', ['authUrl' => $authUrl]);
        }

        $userData = Session::get('user_data');

        return view('profile', ['userData' => $userData]);
    }

    // Просмотр произвольного профиля по CID
    public function show($id)
    {
        if (!Session::has('user_data') || !Session::has('access_token')) {
            return redirect()->route('profile');
        }

        $currentUser = Session::get('user_data');
        $currentCid = $currentUser['data']['cid'] ?? null;

        $adminCids = ['10000010']; // Добавь свои CID админов

        if ($currentCid == $id || in_array($currentCid, $adminCids)) {
            $accessToken = Session::get('access_token');

            $response = Http::withToken($accessToken)->get("https://auth-dev.vatsim.net/api/user/{$id}");

            if (!$response->successful()) {
                abort(404, 'Пользователь не найден');
            }

            $userData = $response->json();

            return view('profile_user', ['userData' => $userData]);
        }

        abort(403, 'Доступ запрещён');
    }
}
