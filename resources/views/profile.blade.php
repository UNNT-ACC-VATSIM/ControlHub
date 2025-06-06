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
        <span>{{ $user_data['data']['cid'] ?? 'Не указано' }}</span>
    </div>

    <div class="field">
        <label>Полное имя:</label>
        <span>{{ $user_data['data']['personal']['name_full'] ?? 'Не указано' }}</span>
    </div>

    <div class="field">
        <label>Email:</label>
        <span>{{ $user_data['data']['personal']['email'] ?? 'Не указано' }}</span>
    </div>

    <div class="field">
        <label>Страна:</label>
        <span>{{ $user_data['data']['personal']['country'] ?? 'Не указано' }}</span>
    </div>

    <div class="field">
        <label>Дата рождения:</label>
        <span>{{ $user_data['data']['personal']['date_of_birth'] ?? 'Не указано' }}</span>
    </div>

    <div class="field">
        <label>Регион:</label>
        <span>{{ $user_data['data']['vatsim']['region'] ?? 'Не указано' }}</span>
    </div>

    <div class="field">
        <label>Дивизион:</label>
        <span>{{ $user_data['data']['vatsim']['division'] ?? 'Не указано' }}</span>
    </div>

    <div class="field">
        <label>Поддивизион:</label>
        <span>{{ $user_data['data']['vatsim']['subdivision'] ?? 'Не указано' }}</span>
    </div>
</div>
</body>
</html>
