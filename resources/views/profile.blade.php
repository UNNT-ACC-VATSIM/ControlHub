<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Профиль VATSIM</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');

        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #e9ecef;
            margin: 0;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            color: #212529;
        }

        .profile-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 480px;
            padding: 2rem;
            box-sizing: border-box;
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

        @media (max-width: 520px) {
            body {
                padding: 1rem;
            }
            .profile-card {
                padding: 1.5rem;
            }
        }

        form {
            text-align: center;
            margin-bottom: 2rem;
        }

        form button {
            background-color: #007bff;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
        }

        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Выйти</button>
</form>
	<div class="profile-card">
		<div class="profile-header">
			<div class="profile-icon">👤</div>
			<h1 class="profile-title">Данные пользователя VATSIM</h1>
		</div>

		<div class="fields">
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
				<span>{{ $user_data['data']['personal']['country']['id'] ?? 'Не указано' }}</span>
			</div>
			<div class="field">
				<label>Регион:</label>
				<span>{{ $user_data['data']['vatsim']['region']['id'] ?? 'Не указано' }}</span>
			</div>
			<div class="field">
				<label>Дивизион:</label>
				<span>{{ $user_data['data']['vatsim']['division']['id'] ?? 'Не указано' }}</span>
			</div>
			<div class="field">
				<label>Поддивизион:</label>
				<span>{{ $user_data['data']['vatsim']['subdivision']['id'] ?? 'Не указано' }}</span>
			</div>
			<div class="field">
				<label>Рейтинг диспетчера:</label>
				<span>{{ $user_data['data']['vatsim']['rating']['long'] ?? 'Не указано' }}</span>
			</div>
			<div class="field">
				<label>Рейтинг пилота:</label>
				<span>{{ $user_data['data']['vatsim']['pilotrating']['long'] ?? 'Не указано' }}</span>
			</div>
		</div>
	</div>
    <pre>{{ print_r($user_data, true) }}</pre>
</body>
</html>
