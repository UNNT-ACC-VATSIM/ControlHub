<div class="user-menu">
    @if(!$user)
        <a href="{{ route('login') }}" class="login-btn">LOGIN</a>
    @else
<button class="user-name-btn" onclick="toggleUserMenu()" style="display: flex; align-items: center;">
    {{ $user['personal']['name_full'] ?? 'Пользователь' }}
    <span class="user-avatar-emoji" style="font-size: 30px; margin-right: 8px;">🎓</span>
</button>
        <ul id="user-dropdown" class="user-dropdown" style="display: none;">
            <li><a href="{{ route('profile') }}">Профиль</a></li>
            <li><a href="{{ route('profile') }}">УТЦ</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn" style="color: white; background-color: #e74c3c; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; font-weight: bold;">
    Выйти
</button>
                </form>
            </li>
        </ul>
    @endif
</div>