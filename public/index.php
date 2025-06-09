<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Проверка на режим обслуживания
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Подключение автозагрузчика Composer
require __DIR__.'/../vendor/autoload.php';

// Загрузка приложения Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// Получаем HTTP Kernel
$kernel = $app->make(Kernel::class);

// Создаем HTTP запрос из глобального состояния PHP
$request = Request::capture();

// Обрабатываем запрос
$response = $kernel->handle($request);

// Отправляем ответ клиенту
$response->send();

// Завершаем обработку запроса (выполняет необходимые действия после отправки ответа)
$kernel->terminate($request, $response);
