<?php
session_start();

function safeOutput($value) {
    if (is_array($value)) {
        return htmlspecialchars(json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
    return htmlspecialchars((string)$value);
}

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $client_id     = '1076';
    $client_secret = 'A0LJOm3NqIdafK3AHxRQDkYwhjZmexHKpPL6CIsh';
    $redirect_uri  = 'http://localhost:8000/auth/callback';

    $token_url = 'https://auth-dev.vatsim.net/oauth/token';

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

    if (!isset($token_data['access_token'])) {
        die("<h2>Ошибка получения токена:</h2><pre>" . safeOutput($token_response) . "</pre>");
    }

    // Получение профиля пользователя
    $user_info_response = file_get_contents('https://auth-dev.vatsim.net/api/user', false, stream_context_create([
        'http' => [
            'method'  => 'GET',
            'header'  => "Authorization: Bearer " . $token_data['access_token'],
        ]
    ]));

    $user_data = json_decode($user_info_response, true);

    if (!$user_data) {
        die("<h2>Ошибка получения данных пользователя</h2>");
    }
    // Сохраняем в сессию
    $_SESSION['user_data'] = $user_data;

    header('Location: /profile');
    exit;
}

if (isset($_SESSION['user_data'])) {
    header('Location: /profile');
    exit;
}

$auth_url = 'https://auth-dev.vatsim.net/oauth/authorize?' . http_build_query([
    'client_id'     => '1076',
    'redirect_uri'  => 'http://localhost:8000/auth/callback',
    'response_type' => 'code',
    'scope'         => 'full_name email vatsim_details country',
]);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход через VATSIM</title>
</head>
<body>
    <h2>Пожалуйста, авторизуйтесь через VATSIM:</h2>
    <a href="<?= htmlspecialchars($auth_url) ?>">Войти через VATSIM</a>
</body>
</html>
