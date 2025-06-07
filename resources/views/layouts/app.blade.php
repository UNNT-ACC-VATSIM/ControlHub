<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Главная')</title>

    <style>
        body, html {
            margin: 0; padding: 0; height: 100%;
            font-family: Arial, sans-serif;
        }
        .layout {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 220px;
            background-color: #007bff;
            color: white;
            padding: 1rem;
            box-sizing: border-box;
        }
        .sidebar ul {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }
        .sidebar ul li {
            margin-bottom: 1rem;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }
        .sidebar ul li a:hover {
            text-decoration: underline;
        }

        .content {
            flex-grow: 1;
            padding: 2rem;
            background-color: #f0f2f5;
        }

        /* Профиль */
        .profile-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            padding: 2rem;
            box-sizing: border-box;
            max-width: 600px;
            margin: 0 auto;
        }
        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .profile-icon {
            font-size: 72px;
            color: #007bff;
            margin-bottom: 0.5rem;
        }
        .profile-title {
            font-weight: 700;
            font-size: 1.8rem;
            color: #007bff;
            margin: 0;
        }
        .fields {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
        }
        .field {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 0.3rem;
        }
        .field label {
            font-weight: 600;
            color: #495057;
        }
        .field span {
            font-weight: 500;
            color: #343a40;
            max-width: 60%;
            text-align: right;
            word-wrap: break-word;
        }
        .logout-btn {
            background-color: #007bff;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            margin-bottom: 2rem;
        }
        .logout-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="layout">
        @include('layouts.sidebar')

        <div class="content">
            <h1>@yield('page_title', 'Заголовок')</h1>
            @yield('content')
        </div>
    </div>
</body>
</html>
