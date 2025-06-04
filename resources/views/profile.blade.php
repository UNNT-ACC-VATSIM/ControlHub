<?php
session_start();

function safeOutput($value) {
    if (is_array($value)) {
        return htmlspecialchars(json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
    return htmlspecialchars((string)$value);
}

// Если пришёл код авторизации, обрабатываем
if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $client_id     = '1076';
    $client_secret = 'Ph8sJqIGnao9Ucx8O7sIdwxRKVKGc39awYfbU4x4';
    $redirect_uri  = 'http://localhost:8000/';

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

    // Получаем данные пользователя
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

    // Сохраняем данные в сессию
    $_SESSION['user_data'] = $user_data;

    // Редирект на чистый URL (без параметров)
    header('Location: http://localhost:8000/');
    exit;
}

// Если данных в сессии нет — предложить авторизоваться
if (!isset($_SESSION['user_data'])) {
    echo '<h2>Пожалуйста, авторизуйтесь</h2>';
    // Можно добавить ссылку на OAuth авторизацию здесь
    exit;
}

$user_data = $_SESSION['user_data'];

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль VATSIM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 2rem;
            color: #333;
        }
        .card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        h1 {
            margin-bottom: 1rem;
            color: #007bff;
        }
        .field {
            margin-bottom: 0.8rem;
        }
        .field label {
            font-weight: bold;
            display: block;
        }
        .field span {
            display: block;
            margin-top: 0.3rem;
        }
    </style>
</head>
<body>
<div class="card">
    <h1>Данные пользователя VATSIM</h1>

    <div class="field">
        <label>CID:</label>
        <span><?= safeOutput($user_data['data']['cid'] ?? 'Не указано') ?></span>
    </div>

    <div class="field">
        <label>Полное имя:</label>
        <span><?= safeOutput($user_data['data']['personal']['name_full'] ?? 'Не указано') ?></span>
    </div>

    <div class="field">
        <label>Email:</label>
        <span><?= safeOutput($user_data['data']['personal']['email'] ?? 'Не указано') ?></span>
    </div>

    <div class="field">
        <label>Страна:</label>
        <span><?= safeOutput($user_data['data']['personal']['country'] ?? 'Не указано') ?></span>
    </div>

    <div class="field">
        <label>Дата рождения:</label>
        <span><?= safeOutput($user_data['data']['personal']['date_of_birth'] ?? 'Не указано') ?></span>
    </div>

    <div class="field">
        <label>Регион:</label>
        <span><?= safeOutput($user_data['data']['vatsim']['region'] ?? 'Не указано') ?></span>
    </div>

    <div class="field">
        <label>Дивизион:</label>
        <span><?= safeOutput($user_data['data']['vatsim']['division'] ?? 'Не указано') ?></span>
    </div>

    <div class="field">
        <label>Поддивизион:</label>
        <span><?= safeOutput($user_data['data']['vatsim']['subdivision'] ?? 'Не указано') ?></span>
    </div>
</div>
</body>
</html>
