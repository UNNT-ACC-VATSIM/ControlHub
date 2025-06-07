<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход через VATSIM</title>
</head>
<body>
    <h2>Пожалуйста, авторизуйтесь через VATSIM:</h2>

    <a href="{{ $auth_url }}">
        <button type="button">Войти через VATSIM</button>
    </a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
