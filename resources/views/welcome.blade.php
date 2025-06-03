<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Региональный центр Новосибирск | VATSIM</title>
  <link rel="icon" href="{{ asset('src/UNNT_ACC.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>
<body>
  <!-- Кнопка "Наверх" -->
@include ('layouts.upbutton')

  <!-- Шапка сайта -->
  <header class="site-header">
    <div class="header-content">
      <div class="logo-container">
        <img src="{{ asset('images/UNNT_ACC.png') }}" alt="Логотип UNNT ACC" class="logo" />
        <img src="{{ asset('images/VATRUS.png') }}" alt="Логотип VATSIM" class="logo" />
      </div>
      <h1 id="main-title"></h1>
      <p class="header-subtitle white-text" id="main-subtitle"></p>
      <div class="header-links">
        <a href="https://vatsim.net" class="header-link" target="_blank">
          <img src="{{ asset('images/vatsim.png') }}" alt="VATSIM" />
          <span id="vatsim-link-text"></span>
        </a>
        <a href="https://discord.gg/unnt" class="header-link" target="_blank">
          <img src="{{ asset('images/discord2.png') }}" alt="Discord" />
          <span id="discord-link-text"></span>
        </a>
      </div>
    </div>
  </header>

@include('layouts.navigation')

  </nav>

  <!-- Основное содержимое -->
  <main class="main-content">
    <!-- О центре -->
    <section class="section">
      <h2 id="about-title" class="section-title"></h2>
      <p id="about-text" class="section-text"></p>

      <div class="cards-grid">
        <div class="card info-card">
          <h3 id="students-title" class="card-title"></h3>
          <p id="students-text" class="card-text"></p>
        </div>

        <div class="card info-card">
          <h3 id="territory-title" class="card-title"></h3>
          <p id="territory-text" class="card-text"></p>
        </div>

        <div class="card info-card">
          <h3 id="stats-title" class="card-title"></h3>
          <p id="stats-text" class="card-text"></p>
        </div>
      </div>
    </section>

    <!-- Аэропорты -->
    <section class="section">
      <h2 id="airports-title" class="section-title"></h2>
      <div class="cards-grid">
        <div class="card airport-card">
          <div class="card-content">
            <h3 class="airport-name"><strong>UNNT</strong></h3>
            <p id="unnt-text" class="airport-description"></p>
          </div>
          <img src="{{ asset('images/UNNT_TERMINAL_SUNSET.png') }}" alt="UNNT Airport" loading="lazy" class="airport-image" />
        </div>

        <div class="card airport-card">
          <div class="card-content">
            <h3 class="airport-name"><strong>UNOO</strong></h3>
            <p id="unoo-text" class="airport-description"></p>
          </div>
          <img src="{{ asset('images/UNOO_TERMINAL.png') }}" alt="UNOO Airport" loading="lazy" class="airport-image" />
        </div>

        <div class="card airport-card">
          <div class="card-content">
            <h3 class="airport-name"><strong>UNBG</strong></h3>
            <p id="unbg-text" class="airport-description"></p>
          </div>
          <img src="{{ asset('images/UNBG_TERMINAL.png') }}" alt="UNBG Airport" loading="lazy" class="airport-image" />
        </div>

        <div class="card airport-card">
          <div class="card-content">
            <h3 class="airport-name"><strong>UNBB</strong></h3>
            <p id="unbb-text" class="airport-description"></p>
          </div>
          <img src="{{ asset('images/UNBB_TERMINAL.png') }}" alt="UNBB Airport" loading="lazy" class="airport-image" />
        </div>

        <div class="card airport-card">
          <div class="card-content">
            <h3 class="airport-name"><strong>UNTT</strong></h3>
            <p id="untt-text" class="airport-description"></p>
          </div>
          <img src="{{ asset('images/UNTT_TERMINAL_1.jpg') }}" alt="UNTT Airport" loading="lazy" class="airport-image" />
        </div>

        <div class="card airport-card">
          <div class="card-content">
            <h3 class="airport-name"><strong>UNEE</strong></h3>
            <p id="unee-text" class="airport-description"></p>
          </div>
          <img src="{{ asset('images/UNEE_TERMINAL_1.png') }}" alt="UNEE Airport" loading="lazy" class="airport-image" />
        </div>

        <div class="card airport-card">
          <div class="card-content">
            <h3 class="airport-name"><strong>UNWW</strong></h3>
            <p id="unww-text" class="airport-description"></p>
          </div>
          <img src="{{ asset('images/UNWW_TERMINAL.jpg') }}" alt="UNWW Airport" loading="lazy" class="airport-image" />
        </div>

        <div class="card airport-card">
          <div class="card-content">
            <h3 class="airport-name"><strong>UNSS</strong></h3>
            <p id="unss-text" class="airport-description"></p>
          </div>
          <img src="{{ asset('images/UNSS_TERMINAL.jpg') }}" alt="UNSS Airport" loading="lazy" class="airport-image" />
        </div>
      </div>
    </section>

    <!-- Контакты -->
    <section class="section">
      <h2 id="info-title" class="section-title"></h2>
      <div class="cards-grid">
        <div class="card info-card">
          <h3 id="contacts-title" class="card-title"></h3>
          <p id="contacts-text" class="card-text"></p>
        </div>

        <div class="card info-card">
          <h3 id="support-title" class="card-title"></h3>
          <p id="support-text" class="card-text"></p>
        </div>
      </div>
    </section>
  </main>

  <!-- Подвал -->
  <footer class="site-footer" id="footer-text"></footer>

  <script>
    // Translations object
    const translations = {
    en: {
    "main-title": "Novosibirsk Regional Center",
    "main-subtitle": "Official Air Traffic Control Center on VATSIM network",
    "vatsim-link-text": "Official VATSIM website",
    "discord-link-text": "Our Discord server",
    "about-title": "About Our Center",
    "about-text": "Novosibirsk FIR provides air traffic control services in the Siberian region on the VATSIM network. Our center combines several major airports and controls vast airspace.",
    "students-title": "More than 40 students",
    "students-text": "We welcome everyone and look forward to having you in our friendly team",
    "territory-title": "Territory",
    "territory-text": "We control airspace of over 3 million km², including 8 major airports.",
    "stats-title": "Statistics",
    "stats-text": "About 150 flights operate daily to the airports in our FIR",
    "airports-title": "Controlled Airports",
    "unnt-text": "Novosibirsk (Tolmachevo)<br>The largest international airport beyond the Urals",
    "unoo-text": "Omsk (Tsentralny)<br>Airport of federal significance",
    "unbg-text": "Gorno-Altaysk<br>Regional airport. One of the most beautiful in our country",
    "unbb-text": "Barnaul (Mikhailovka)<br>International airport",
    "untt-text": "Tomsk (Bogashevo)<br>Federal airport",
    "unee-text": "Kemerovo<br>Regional airport",
    "unww-text": "Novokuznetsk (Spichenkovo)<br>Regional airport",
    "unss-text": "Strejevoi<br>Local airport",
    "info-title": "Useful Information",
    "contacts-title": "Contacts",
    "contacts-text": "To contact us, please use the email address: <a href=\"mailto:unnt-fir@outlook.com\" class=\"email-link\">unnt-fir@outlook.com</a>",
    "support-title": "Support Services",
    "support-text": "Our controllers are always ready to help. For assistance, join our Discord server.",
    "footer-text": "© 2025 Tolmachevo Airport (Novosibirsk). All rights reserved. Not affiliated with real aviation services.",        
    "home-link": "Home"
  },
  ru: {
    "main-title": "Региональный центр Новосибирск",
    "main-subtitle": "Официальный центр управления воздушным движением в сети VATSIM",
    "vatsim-link-text": "Официальный сайт VATSIM",
    "discord-link-text": "Наш Discord-сервер",
    "about-title": "О нашем центре",
    "about-text": "Региональный центр Новосибирск (Novosibirsk FIR) обеспечивает управление воздушным движением в Сибирском регионе в сети VATSIM. Наш центр объединяет несколько крупных аэропортов и контролирует обширное воздушное пространство.",
    "students-title": "Более 40 студентов",
    "students-text": "Мы ради каждому и ждём любого в нашей дружной команде",
    "territory-title": "Территория",
    "territory-text": "Мы контролируем воздушное пространство площадью более 3 млн км², включая 8 крупных аэропортов.",
    "stats-title": "Статистика",
    "stats-text": "Около 150 рейсов выполняется в аэропорты нашего РегЦ ежедневно",
    "airports-title": "Подконтрольные аэропорты",
    "unnt-text": "Новосибирск (Толмачёво)<br>Крупнейший международный аэропорт за Уралом",
    "unoo-text": "Омск (Центральный)<br>Аэропорт федерального значения",
    "unbg-text": "Горно-Алтайск<br>Региональный аэропорт. Один из самых красивых в нашей стране",
    "unbb-text": "Барнаул (Михайловка)<br>Международный аэропорт",
    "untt-text": "Томск (Богашёво)<br>Федеральный аэропорт",
    "unee-text": "Кемерово<br>Региональный аэропорт",
    "unww-text": "Новокузнецк (Спиченково)<br>Региональный аэропорт",
    "unss-text": "Стрежевой<br>Местный аэропорт",
    "info-title": "Полезная информация",
    "contacts-title": "Контакты",
    "contacts-text": "Для связи с нами, пожалуйста, используйте адрес электронной почты: <a href=\"mailto:unnt-fir@outlook.com\" class=\"email-link\">unnt-fir@outlook.com</a>",
    "support-title": "Службы поддержки",
    "support-text": "Наши диспетчеры всегда готовы помочь. Для получения помощи присоединяйтесь к нашему Discord-серверу.",
    "footer-text": "© 2025 Аэропорт Толмачёво (Новосибирск). Все права защищены. Не связан с реальными авиационными службами.",
    "home-link": "Главная"
  }
};

// Function to switch language
function switchLanguage(lang) {
  // Update button states
  document.querySelectorAll('.lang-btn').forEach(btn => {
    btn.classList.toggle('active', btn.dataset.lang === lang);
  });
  
  // Update content
  const elements = document.querySelectorAll('[id]');
  elements.forEach(element => {
    const key = element.id;
    if (translations[lang] && translations[lang][key]) {
      if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
        element.value = translations[lang][key];
      } else {
        element.innerHTML = translations[lang][key];
      }
    }
  });
  
  // Update HTML lang attribute
  document.documentElement.lang = lang;
  
  // Save language preference
  localStorage.setItem('preferredLanguage', lang);
}

// Set default language
document.addEventListener('DOMContentLoaded', function() {
  // Check for saved preference or use browser language
  const savedLang = localStorage.getItem('preferredLanguage');
  const browserLang = navigator.language.startsWith('ru') ? 'ru' : 'en';
  const defaultLang = savedLang || browserLang;
  
  // Set the language
  switchLanguage(defaultLang);
});
const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const navContainer = document.querySelector('.nav-container');

// Плавное открытие/закрытие меню
mobileMenuBtn.addEventListener('click', () => {
  navContainer.classList.toggle('mobile-active');
  
  // Меняем иконку гамбургера на "✕" при открытии
  if (navContainer.classList.contains('mobile-active')) {
    mobileMenuBtn.textContent = '✕';
  } else {
    mobileMenuBtn.textContent = '☰';
  }
});

// Закрытие меню при ресайзе (если вдруг пользователь повернул телефон)
window.addEventListener('resize', () => {
  if (window.innerWidth > 768) {
    navContainer.classList.remove('mobile-active');
    mobileMenuBtn.textContent = '☰';
  }
});


  </script>
</body>
</html>