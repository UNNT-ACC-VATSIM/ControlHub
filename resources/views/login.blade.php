<?php
// Настройки твоего приложения
$client_id     = '1076';
$redirect_uri  = 'http://localhost:8000/'; // Укажи свой локальный адрес
$response_type = 'code';
$scope         = 'full_name vatsim_details email';

// Ссылка на авторизацию в sandbox
$auth_url = "https://auth-dev.vatsim.net/oauth/authorize?" . http_build_query([
    'client_id'     => $client_id,
    'redirect_uri'  => $redirect_uri,
    'response_type' => $response_type,
    'scope'         => $scope,
]);

// Перенаправляем пользователя
header("Location: $auth_url");
exit;
