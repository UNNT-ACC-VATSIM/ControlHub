<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\VatsimUser;
use Carbon\Carbon;

class VatsimLoginController extends Controller
{
    private string $client_id = '1076';
    private string $client_secret = 'A0LJOm3NqIdafK3AHxRQDkYwhjZmexHKpPL6CIsh';
    private string $redirect_uri = 'http://localhost:8000/auth/callback';

    public function showLogin()
    {
        if (Session::has('user_data')) {
            $user = Session::get('user_data')['data'] ?? null;
            $cid = $user['cid'] ?? null;
            if ($cid) {
                return redirect()->route('profile.show', ['cid' => $cid]);
            }
            return redirect()->route('home');
        }

        $auth_url = 'https://auth-dev.vatsim.net/oauth/authorize?' . http_build_query([
            'client_id'     => $this->client_id,
            'redirect_uri'  => $this->redirect_uri,
            'response_type' => 'code',
            'scope'         => 'full_name email vatsim_details country',
        ]);

        return view('login', compact('auth_url'));
    }

    public function handleProviderCallback(Request $request)
    {
        if (!$request->has('code')) {
            return redirect()->route('login')->with('error', 'Код авторизации не получен.');
        }

        $tokenResponse = Http::asForm()->post('https://auth-dev.vatsim.net/oauth/token', [
            'grant_type'    => 'authorization_code',
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri'  => $this->redirect_uri,
            'code'          => $request->code,
        ]);

        if (!$tokenResponse->successful() || empty($tokenResponse['access_token'])) {
            return redirect()->route('login')->with('error', 'Не удалось получить токен.');
        }

        $access_token = $tokenResponse['access_token'];

        $userResponse = Http::withToken($access_token)->get('https://auth-dev.vatsim.net/api/user');

        if (!$userResponse->successful()) {
            return redirect()->route('login')->with('error', 'Не удалось получить данные пользователя.');
        }

        $user_data = $userResponse->json();

        // Сохраняем в сессию
        Session::put('user_data', $user_data);
        Session::put('access_token', $access_token);

        // Сохраняем или обновляем профиль пользователя в базе
        $cid = $user_data['data']['cid'] ?? null;
        if ($cid) {
            VatsimUser::updateOrCreate(
                ['cid' => $cid],
                [
                    'profile_data' => json_encode($user_data),
                    'updated_at' => now(),
                ]
            );
        }

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Вы успешно вышли из системы.');
    }

    public function unnt()
    {
        if (!Session::has('user_data')) {
            return redirect()->route('login');
        }

        return view('airports.unnt', [
            'activePage' => 'unnt',
            'title' => 'Региональный центр Новосибирск',
            'subtitle' => 'Официальный центр управления воздушным движением в сети VATSIM'
        ]);
    }

    private function getSystemAccessToken()
    {
        $response = Http::asForm()->post('https://auth-dev.vatsim.net/oauth/token', [
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
        ]);

        if ($response->successful() && !empty($response['access_token'])) {
            return $response['access_token'];
        }

        return null;
    }

    public function showUserProfile($cid)
    {
        if (!session()->has('user_data')) {
            return redirect()->route('login');
        }

        $currentUser = session('user_data');
        $currentCid = $currentUser['data']['cid'] ?? null;
        $adminCids = ['10000010'];

        // Попытаемся получить профиль из БД
        $cachedProfile = VatsimUser::where('cid', $cid)->first();

        $shouldRefresh = true;
        if ($cachedProfile) {
            // Если профиль обновлялся менее 5 минут назад — берем из кэша
            $updatedAt = Carbon::parse($cachedProfile->updated_at);
            if ($updatedAt->gt(now()->subMinutes(5))) {
                $shouldRefresh = false;
            }
        }

        if ($currentCid == $cid) {
            if ($shouldRefresh) {
                $accessToken = session('access_token');
                $response = Http::withToken($accessToken)->get("https://auth-dev.vatsim.net/api/user");

                if ($response->successful()) {
                    $userData = $response->json();

                    // Обновляем базу
                    VatsimUser::updateOrCreate(
                        ['cid' => $cid],
                        ['profile_data' => json_encode($userData), 'updated_at' => now()]
                    );

                    return view('profile', ['user_data' => $userData]);
                } else {
                    // Если не удалось получить с API — отдаём кеш или ошибку
                    if ($cachedProfile) {
                        return view('profile', ['user_data' => json_decode($cachedProfile->profile_data, true)]);
                    }
                    abort($response->status(), 'Ошибка API: не удалось получить данные пользователя.');
                }
            } else {
                // Отдаем из кеша
                return view('profile', ['user_data' => json_decode($cachedProfile->profile_data, true)]);
            }
        } elseif (in_array($currentCid, $adminCids)) {
            // Админ может смотреть чужой профиль, всегда обновляем с API

            $accessToken = $this->getSystemAccessToken();

            if (!$accessToken) {
                abort(500, 'Не удалось получить системный токен для API VATSIM.');
            }

            $response = Http::withToken($accessToken)->get("https://auth-dev.vatsim.net/api/user/{$cid}");

            if (!$response->successful()) {
                // Если ошибка, отдаем кеш если есть
                if ($cachedProfile) {
                    return view('profile', ['user_data' => json_decode($cachedProfile->profile_data, true)]);
                }
                abort($response->status(), 'Ошибка API: не удалось получить данные пользователя.');
            }

            $userData = $response->json();

            // Обновляем базу
            VatsimUser::updateOrCreate(
                ['cid' => $cid],
                ['profile_data' => json_encode($userData), 'updated_at' => now()]
            );

            return view('profile', ['user_data' => $userData]);
        } else {
            abort(403, 'Доступ запрещён');
        }
    }
}
