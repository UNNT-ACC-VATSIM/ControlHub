@extends('layouts.app')

@section('title', 'UNNT')

@section('header-style')
<style>
.site-header::before {
  content: "";
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background: url('/images/UNNT_TERMINAL_SUNSET.png') center/cover no-repeat;
  opacity: 0.15;
  z-index: 0;
}
</style>
@endsection

@section('content')

@section('header-title', 'Аэропорт Новосибирск (Толмачёво)')
@section('header-subtitle', 'Крупнейший авиационный хаб за Уралом')

<div class="under-construction-content">
  <div class="under-construction-message-box">
    <h1 id="main-heading">В разработке</h1>
    <p id="main-text">Эта страница находится в процессе создания. Возвращайтесь позже!</p>
    <a href="{{ url('/home') }}" class="under-construction-home-button" id="home-button">На главную</a>
  </div>
</div>

@endsection

@section('scripts')
<script>
  const translations = {
    en: {
      "page-title": "Under Development",
      "main-heading": "Under Development",
      "main-text": "This page is currently being developed. Please check back later!",
      "home-button": "Home",
      "home-link": "Home"
    },
    ru: {
      "page-title": "В разработке",
      "main-heading": "В разработке",
      "main-text": "Эта страница находится в процессе создания. Возвращайтесь позже!",
      "home-button": "На главную",
      "home-link": "На главную"
    }
  };

  function switchLanguage(lang) {
    document.querySelectorAll('.lang-btn').forEach(btn => {
      btn.classList.toggle('active', btn.dataset.lang === lang);
    });
    const elements = document.querySelectorAll('[id]');
    elements.forEach(element => {
      const key = element.id;
      if (translations[lang][key]) {
        element.innerHTML = translations[lang][key];
      }
    });
    localStorage.setItem('preferredLanguage', lang);
  }

  document.addEventListener('DOMContentLoaded', () => {
    const savedLang = localStorage.getItem('preferredLanguage');
    const browserLang = navigator.language.startsWith('ru') ? 'ru' : 'en';
    const defaultLang = savedLang || browserLang;

    const defaultBtn = document.querySelector(`.lang-btn[data-lang="${defaultLang}"]`);
    if (defaultBtn) defaultBtn.classList.add('active');

    switchLanguage(defaultLang);
  });
</script>
@endsection
