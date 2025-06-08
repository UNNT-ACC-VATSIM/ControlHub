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

        return view('login', compact('auth_url'));
    }

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

        Session::put('user_data', $user_data);

        return redirect()->route('home');
    }

    public function profile()
    {
        $user_data = Session::get('user_data');

        if (!$user_data) {
            return redirect()->route('login');
        }

        return view('profile', compact('user_data'));
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::forget('user_data');

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

    /**
     * Просмотр произвольного профиля по CID
     */
public function showUserProfile($id)
{
    $currentUser = Session::get('user_data');

    if (!$currentUser) {
        return redirect()->route('login');
    }

    $currentCid = $currentUser['data']['cid'] ?? null;

    // CID админов (замени на реальные CID)
    $adminCids = ['10000010'];

    // Проверяем права: либо это профиль текущего пользователя, либо админ
    if ((string)$currentCid !== (string)$id && !in_array($currentCid, $adminCids)) {
        abort(403, 'Доступ запрещён');
    }

    // Получаем системный токен для доступа к API (реализуй метод, или временно используй токен текущего пользователя)
    $accessToken = $this->getSystemAccessToken();

    if (!$accessToken) {
        abort(500, 'Не удалось получить системный токен для доступа к API');
    }

    // Запрашиваем данные пользователя по CID
    $response = Http::withToken($accessToken)->get("https://auth-dev.vatsim.net/api/user/{$id}");

    if (!$response->successful()) {
        abort(404, 'Пользователь не найден');
    }

    $user_data = $response->json();

    // Возвращаем тот же шаблон профиля, но с данными нужного пользователя
    return view('home', compact('user_data'));
}

/**
 * Пример метода получения системного токена для API
 * Тебе нужно реализовать этот метод — 
 * например, делать запрос oauth/token с grant_type=client_credentials
 */
private function getSystemAccessToken()
{
    $response = Http::asForm()->post('https://auth-dev.vatsim.net/oauth/token', [
        'grant_type' => 'client_credentials',
        'client_id' => $this->client_id,
        'client_secret' => $this->client_secret,
    ]);

    if ($response->successful() && !empty($response['access_token'])) {
        return $response['access_token'];
    }

    return null;
}
}
