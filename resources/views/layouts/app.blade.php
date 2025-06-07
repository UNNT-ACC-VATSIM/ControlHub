<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.header') <!-- Подключаем header.blade.php -->
</head>
    @include('layouts.cap') <!-- Подключаем cap.blade.php -->
    @include('layouts.nav-menu') <!-- Подключаем navmenu.blade.php -->
    
    <main class="content">
        @yield('content') <!-- Основное содержимое страниц -->
    </main>

    @include('layouts.footer') <!-- Если у вас есть футер -->

    <!-- Скрипты -->
    @vite(['resources/js/app.js'])
    
    <!-- Дополнительные скрипты из секций -->
    @yield('scripts')
</body>
</html>