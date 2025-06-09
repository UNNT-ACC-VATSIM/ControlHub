<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    private string $client_id = '1076';
    private string $client_secret = 'A0LJOm3NqIdafK3AHxRQDkYwhjZmexHKpPL6CIsh';

    /**
     * Главная страница профиля и обработка OAuth callback
     */
    public function index(Request $request)
    {
        // Если получен код авторизации от OAuth
        if ($request->has('code')) {
            $code = $request->get('code');
            $redirect_uri = route('profile'); // Этот route должен совпадать с URL в OAuth настройках

            // Запрос токена доступа
            $tokenResponse = Http::asForm()->post('https://auth-dev.vatsim.net/oauth/token', [
                'grant_type'    => 'authorization_code',
                'client_id'     => $this->client_id,
                'client_secret' => $this->client_secret,
                'redirect_uri'  => $redirect_uri,
                'code'          => $code,
            ]);

            if (!$tokenResponse->successful() || !isset($tokenResponse['access_token'])) {
                abort(500, 'Ошибка получения токена авторизации.');
            }

            $access_token = $tokenResponse['access_token'];

            // Запрос данных пользователя с использованием токена
            $userInfoResponse = Http::withToken($access_token)->get('https://auth-dev.vatsim.net/api/user');

            if (!$userInfoResponse->successful()) {
                abort(500, 'Ошибка получения данных пользователя.');
            }

            $userData = $userInfoResponse->json();

            // Сохраняем в сессию токен и данные пользователя
            Session::put('user_data', $userData);
            Session::put('access_token', $access_token);

            // **После входа редиректим на /home**
            return redirect()->route('home');
        }

        // Если пользователь не авторизован, показываем ссылку на логин
        if (!Session::has('user_data')) {
            $authUrl = 'https://auth-dev.vatsim.net/oauth/authorize?' . http_build_query([
                'client_id'     => $this->client_id,
                'redirect_uri'  => route('profile'),
                'response_type' => 'code',
                'scope'         => 'full_name email vatsim_details country',
            ]);

            return view('login', ['authUrl' => $authUrl]);
        }

        // Пользователь авторизован — показываем профиль
        $userData = Session::get('user_data');

        return view('profile', ['userData' => $userData]);
    }

    /**
     * Получить системный токен (для админских запросов к API)
     */
    private function getSystemAccessToken()
    {
        $response = Http::asForm()->post('https://auth-dev.vatsim.net/oauth/token', [
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
        ]);

        if ($response->successful() && isset($response['access_token'])) {
            return $response['access_token'];
        }

        return null;
    }

    /**
     * Просмотр профиля пользователя по CID
     */
    public function show($cid)
    {
        // Проверяем, что пользователь авторизован и есть данные
        if (!Session::has('user_data')) {
            return redirect()->route('profile');
        }

        $currentUser = Session::get('user_data');
        $currentCid = $currentUser['data']['cid'] ?? null;

        // Список CID администраторов (доступ к любым профилям)
        $adminCids = ['10000010']; // Добавьте свои CID админов

        // Разрешаем просмотр, если это свой профиль или админ
        if ($currentCid == $cid || in_array($currentCid, $adminCids)) {
            // Если админ смотрит чужой профиль — используем системный токен
            if ($currentCid != $cid) {
                $accessToken = $this->getSystemAccessToken();
                if (!$accessToken) {
                    abort(500, 'Не удалось получить системный токен.');
                }
            } else {
                // Для своего профиля — используем токен пользователя из сессии
                $accessToken = Session::get('access_token');
            }

            $response = Http::withToken($accessToken)->get("https://auth-dev.vatsim.net/api/user/{$cid}");

            if (!$response->successful()) {
                abort(404, 'Пользователь не найден.');
            }

            $userData = $response->json();

            return view('profile_user', ['userData' => $userData]);
        }

        abort(403, 'Доступ запрещен.');
    }
}
