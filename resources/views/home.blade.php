<?php
if (!isset($_GET['code'])) {
    die('Нет кода авторизации');
}

$code = $_GET['code'];

// Твои данные
$client_id     = '1076';
$client_secret = 'Ph8sJqIGnao9Ucx8O7sIdwxRKVKGc39awYfbU4x4';
$redirect_uri  = 'http://localhost:8000/';

$token_url = 'https://auth-dev.vatsim.net/oauth/token';

// Запрашиваем токен
$token_response = file_get_contents($token_url, false, stream_context_create([
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
        'content' => http_build_query([
            'grant_type'    => 'authorization_code',
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri'  => $redirect_uri,
            'code'          => $code,
        ]),
    ]
]));

$token_data = json_decode($token_response, true);

if (isset($token_data['access_token'])) {
    // Теперь запрашиваем данные пользователя
    $user_info = file_get_contents('https://auth-dev.vatsim.net/api/user', false, stream_context_create([
        'http' => [
            'method'  => 'GET',
            'header'  => "Authorization: Bearer " . $token_data['access_token'],
        ]
    ]));

    echo "<h1>Данные пользователя:</h1>";
    echo "<pre>" . htmlspecialchars($user_info, ENT_QUOTES) . "</pre>";
} else {
    echo "<h2>Ошибка:</h2><pre>" . htmlspecialchars($token_response, ENT_QUOTES) . "</pre>";
}
