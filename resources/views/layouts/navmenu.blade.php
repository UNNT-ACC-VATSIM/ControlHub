@php
    $user = session('user_data.data') ?? null;
@endphp
<!-- Навигационное меню -->
<nav class="main-nav">
    <div class="nav-container">
        <button class="mobile-menu-btn" aria-label="Меню">☰</button>
        <div class="nav-links">
            <a href="{{ url('/home') }}" class="nav-link {{ request()->is('home') ? 'home-link' : '' }}">{{ __('Главная') }}</a>
            <a href="{{ url('/unnt') }}" class="nav-link {{ request()->is('unnt') ? 'home-link' : '' }}">UNNT</a>
            <a href="{{ url('/unoo') }}" class="nav-link {{ request()->is('unoo') ? 'home-link' : '' }}">UNOO</a>
            <a href="{{ url('/unbg') }}" class="nav-link {{ request()->is('unbg') ? 'home-link' : '' }}">UNBG</a>
            <a href="{{ url('/unbb') }}" class="nav-link {{ request()->is('unbb') ? 'home-link' : '' }}">UNBB</a>
            <a href="{{ url('/untt') }}" class="nav-link {{ request()->is('untt') ? 'home-link' : '' }}">UNTT</a>
            <a href="{{ url('/unee') }}" class="nav-link {{ request()->is('unee') ? 'home-link' : '' }}">UNEE</a>
            <a href="{{ url('/unww') }}" class="nav-link {{ request()->is('unww') ? 'home-link' : '' }}">UNWW</a>
            <a href="{{ url('/unss') }}" class="nav-link {{ request()->is('unss') ? 'home-link' : '' }}">UNSS</a>
        </div>
        <div class="language-switcher">
            <button class="lang-btn active" data-lang="ru" onclick="switchLanguage('ru')">
                <img src="{{ asset('images/RU.jpg') }}" alt="Русский" class="lang-flag" title="Русский">
            </button>
            <button class="lang-btn" data-lang="en" onclick="switchLanguage('en')">
                <img src="{{ asset('images/UK.jpg') }}" alt="English" class="lang-flag" title="English">
            </button>
        </div>
        @include('layouts.user-menu')
 </nav>
<script>
    function toggleUserMenu() {
        const dropdown = document.getElementById('user-dropdown');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    // Чтобы закрыть меню по клику вне его
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('user-dropdown');
        const button = document.querySelector('.user-name-btn');
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });
</script>