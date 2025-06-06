<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        session_start();

        if ($request->has('code')) {
            $code = $request->get('code');

            $client_id = '1076';
            $client_secret = 'Твой_секрет';
            $redirect_uri = route('profile'); // http://localhost:8000/profile

            // Запрос токена (можно через Guzzle или file_get_contents)
            $tokenResponse = file_get_contents('https://auth-dev.vatsim.net/oauth/token', false, stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                    'content' => http_build_query([
                        'grant_type' => 'authorization_code',
                        'client_id' => $client_id,
                        'client_secret' => $client_secret,
                        'redirect_uri' => $redirect_uri,
                        'code' => $code,
                    ]),
                ],
            ]));

            $tokenData = json_decode($tokenResponse, true);

            if (!isset($tokenData['access_token'])) {
                abort(500, 'Ошибка получения токена');
            }

            // Получаем данные пользователя
            $userInfoResponse = file_get_contents('https://auth-dev.vatsim.net/api/user', false, stream_context_create([
                'http' => [
                    'method' => 'GET',
                    'header' => "Authorization: Bearer " . $tokenData['access_token'],
                ],
            ]));

            $userData = json_decode($userInfoResponse, true);

            if (!$userData) {
                abort(500, 'Ошибка получения данных пользователя');
            }

            $_SESSION['user_data'] = $userData;

            // Редирект без code, чтобы очистить URL
            return redirect()->route('profile');
        }

        // Если не авторизован
        if (!isset($_SESSION['user_data'])) {
            $authUrl = 'https://auth-dev.vatsim.net/oauth/authorize?' . http_build_query([
                'client_id' => '1076',
                'redirect_uri' => route('profile'),
                'response_type' => 'code',
                'scope' => 'full_name email',
            ]);
            return view('login', ['authUrl' => $authUrl]);
        }

        $userData = $_SESSION['user_data'];

        return view('profile', ['userData' => $userData]);
    }
}
