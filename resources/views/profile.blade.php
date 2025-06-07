@extends('layouts.app')

@section('title', 'Профиль VATSIM')
@section('page_title', 'Профиль')

@section('content')
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Выйти</button>
    </form>

    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-icon">👤</div>
            <h1 class="profile-title">Данные пользователя VATSIM</h1>
        </div>

        <div class="fields">
            @php
                $user = $user_data['data'] ?? [];
            @endphp
            @foreach ([
                'CID' => $user['cid'] ?? 'Не указано',
                'Полное имя' => $user['personal']['name_full'] ?? 'Не указано',
                'Email' => $user['personal']['email'] ?? 'Не указано',
                'Страна' => $user['personal']['country']['name'] ?? 'Не указано',
                'Регион' => ($user['vatsim']['region']['name'] ?? 'Не указано') . ' (' . ($user['vatsim']['region']['id'] ?? '') . ')',
                'Дивизион' => ($user['vatsim']['division']['name'] ?? 'Не указано') . ' (' . ($user['vatsim']['division']['id'] ?? '') . ')',
                'Поддивизион' => ($user['vatsim']['subdivision']['name'] ?? 'Не указано') . ' (' . ($user['vatsim']['subdivision']['id'] ?? '') . ')',
                'Рейтинг диспетчера' => ($user['vatsim']['rating']['long'] ?? 'Не указано') . ' (' . ($user['vatsim']['rating']['short'] ?? '') . ')',
                'Рейтинг пилота' => ($user['vatsim']['pilotrating']['long'] ?? 'Не указано') . ' (' . ($user['vatsim']['pilotrating']['short'] ?? '') . ')',
            ] as $label => $value)
                <div class="field">
                    <label>{{ $label }}:</label>
                    <span>{{ $value }}</span>
                </div>
            @endforeach
        </div>
    </div>
@endsection
