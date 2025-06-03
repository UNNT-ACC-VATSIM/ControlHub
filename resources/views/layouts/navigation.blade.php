<nav class="main-nav">
  <div class="nav-container">
    <button class="mobile-menu-btn" aria-label="Меню">☰</button>
    <div class="nav-links">
      <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Главная</a>
      <a href="{{ url('/unnt') }}" class="nav-link {{ request()->is('unnt') ? 'active' : '' }}">UNNT</a>
      <a href="{{ url('/unoo') }}" class="nav-link {{ request()->is('unoo') ? 'active' : '' }}">UNOO</a>
      <a href="{{ url('/unbg') }}" class="nav-link {{ request()->is('unbg') ? 'active' : '' }}">UNBG</a>
      <a href="{{ url('/unbb') }}" class="nav-link {{ request()->is('unbb') ? 'active' : '' }}">UNBB</a>
      <a href="{{ url('/untt') }}" class="nav-link {{ request()->is('untt') ? 'active' : '' }}">UNTT</a>
      <a href="{{ url('/unee') }}" class="nav-link {{ request()->is('unee') ? 'active' : '' }}">UNEE</a>
      <a href="{{ url('/unww') }}" class="nav-link {{ request()->is('unww') ? 'active' : '' }}">UNWW</a>
      <a href="{{ url('/unss') }}" class="nav-link {{ request()->is('unss') ? 'active' : '' }}">UNSS</a>
    </div>
    <div class="language-switcher">
      <button class="lang-btn active" data-lang="ru" onclick="switchLanguage('ru')">
        <img src="{{ asset('images/RU.jpg') }}" alt="Русский" class="lang-flag" title="Русский" />
      </button>
      <button class="lang-btn" data-lang="en" onclick="switchLanguage('en')">
        <img src="{{ asset('images/UK.jpg') }}" alt="English" class="lang-flag" title="English" />
      </button>
    </div>
  </div>
</nav>
