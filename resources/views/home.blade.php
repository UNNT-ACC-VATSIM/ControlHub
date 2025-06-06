<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Главная страница</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            max-width: 900px;
            margin: 2rem auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .sidebar {
            flex: 1;
            background-color: #007bff;
            color: white;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .sidebar a.avatar-link {
            display: inline-block;
            border-radius: 50%;
            border: 3px solid white;
            background-color: white;
            overflow: hidden;
            margin-bottom: 1rem;
            width: 100px;
            height: 100px;
            cursor: pointer;
            transition: box-shadow 0.3s ease;
        }
        .sidebar a.avatar-link:hover {
            box-shadow: 0 0 10px rgba(255,255,255,0.8);
        }
        .sidebar img.avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            display: block;
        }
        .sidebar h2 {
            margin: 0;
            font-weight: normal;
            font-size: 1.3rem;
        }
        .content {
            flex: 2;
            padding: 2rem;
        }
        .menu {
            border-left: 1px solid #ddd;
            padding-left: 2rem;
        }
        .menu h3 {
            margin-top: 0;
            margin-bottom: 1rem;
            color: #333;
        }
        .menu ul {
            list-style: none;
            padding-left: 0;
        }
        .menu ul li {
            margin-bottom: 0.8rem;
        }
        .menu ul li a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }
        .menu ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
@php
    // Берём user_data из сессии
    $user = session('user_data');
    $name = $user['data']['personal']['name_full'] ?? 'Неизвестный пользователь';
@endphp

<div class="container">
    <div class="sidebar">
        <a href="{{ route('profile') }}" class="avatar-link" title="Перейти в профиль">
            <img class="avatar" src="https://cdn-icons-png.flaticon.com/512/147/147144.png" alt="User Avatar" />
        </a>
        <h2>{{ $name }}</h2>
    </div>
    <div class="content">
        <h1>Добро пожаловать, {{ $name }}!</h1>
        <div class="menu">
            <h3>Разделы</h3>
            <ul>
                <li><a href="#">Тренажеры</a></li>
                <li><a href="#">Инструкторы</a></li>
                <li><a href="#">Расписание</a></li>
                <li><a href="#">Сообщения</a></li>
                <li><a href="#">Настройки</a></li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
