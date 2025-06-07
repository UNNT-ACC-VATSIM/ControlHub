<header class="site-header">
    <div class="header-content">
        <div class="logo-container">
            <img src="{{ asset('images/UNNT_ACC.png') }}" alt="Логотип UNNT ACC" class="logo">
            <img src="{{ asset('images/VATRUS.png') }}" alt="Логотип VATSIM" class="logo">
        </div>

        <h1>@yield('header-title', __('Региональный центр Новосибирск'))</h1>

        <p class="header-subtitle white-text">
            @yield('header-subtitle', __('Официальный центр управления воздушным движением в сети VATSIM'))
        </p>

        <div class="header-links">
            <a href="https://vatsim.net" class="header-link" target="_blank">
                <img src="{{ asset('images/vatsim.png') }}" alt="VATSIM">
                <span>{{ __('Официальный сайт VATSIM') }}</span>
            </a>
            <a href="https://discord.gg/unnt" class="header-link" target="_blank">
                <img src="{{ asset('images/discord2.png') }}" alt="Discord">
                <span>{{ __('Наш Discord-сервер') }}</span>
            </a>
        </div>
    </div>
</header>
