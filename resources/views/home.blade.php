@extends('layouts.app')

@section('title', __('Региональный центр Новосибирск | VATSIM'))

@section('header-title', __('Региональный центр Новосибирск'))
@section('header-subtitle', __('Официальный центр управления воздушным движением в сети VATSIM'))

@section('content')
    <!-- Кнопка "Наверх" -->
    <button id="scrollToTopBtn" aria-label="Наверх" class="scroll-top-btn">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="white">
            <path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.59 5.58L20 12l-8-8-8 8z"/>
        </svg>
    </button>

    <!-- Основное содержимое -->
    <main class="main-content">
        <!-- О центре -->
        <section class="section">
            <h2 class="section-title">{{ __('О нашем центре') }}</h2>
            <p class="section-text">{{ __('Региональный центр Новосибирск (Novosibirsk FIR) обеспечивает управление воздушным движением в Сибирском регионе в сети VATSIM. Наш центр объединяет несколько крупных аэропортов и контролирует обширное воздушное пространство.') }}</p>
            
            <div class="cards-grid">
                <div class="card info-card">
                    <h3 class="card-title">{{ __('Более 40 студентов') }}</h3>
                    <p class="card-text">{{ __('Мы ради каждому и ждём любого в нашей дружной команде') }}</p>
                </div>
                
                <div class="card info-card">
                    <h3 class="card-title">{{ __('Территория') }}</h3>
                    <p class="card-text">{{ __('Мы контролируем воздушное пространство площадью более 3 млн км², включая 8 крупных аэропортов.') }}</p>
                </div>
                
                <div class="card info-card">
                    <h3 class="card-title">{{ __('Статистика') }}</h3>
                    <p class="card-text">{{ __('Около 150 рейсов выполняется в аэропорты нашего РегЦ ежедневно') }}</p>
                </div>
            </div>
        </section>

        <!-- Аэропорты -->
        <section class="section">
            <h2 class="section-title">{{ __('Подконтрольные аэропорты') }}</h2>
            <div class="cards-grid">
                <div class="card airport-card">
                    <div class="card-content">
                        <h3 class="airport-name"><strong>UNNT</strong></h3>
                        <p class="airport-description">{{ __('Новосибирск (Толмачёво)<br>Крупнейший международный аэропорт за Уралом') }}</p>
                    </div>
                    <img src="{{ asset('images/UNNT_TERMINAL_SUNSET.png') }}" alt="UNNT Airport" loading="lazy" class="airport-image">
                </div>
                
                <div class="card airport-card">
                    <div class="card-content">
                        <h3 class="airport-name"><strong>UNOO</strong></h3>
                        <p class="airport-description">{{ __('Омск (Центральный)<br>Аэропорт федерального значения') }}</p>
                    </div>
                    <img src="{{ asset('images/UNOO_TERMINAL.png') }}" alt="UNOO Airport" loading="lazy" class="airport-image">
                </div>
                
                <div class="card airport-card">
                    <div class="card-content">
                        <h3 class="airport-name"><strong>UNBG</strong></h3>
                        <p class="airport-description">{{ __('Горно-Алтайск<br>Региональный аэропорт. Один из самых красивых в нашей стране') }}</p>
                    </div>
                    <img src="{{ asset('images/UNBG_TERMINAL.png') }}" alt="UNBG Airport" loading="lazy" class="airport-image">
                </div>
                
                <div class="card airport-card">
                    <div class="card-content">
                        <h3 class="airport-name"><strong>UNBB</strong></h3>
                        <p class="airport-description">{{ __('Барнаул (Михайловка)<br>Международный аэропорт') }}</p>
                    </div>
                    <img src="{{ asset('images/UNBB_TERMINAL.png') }}" alt="UNBB Airport" loading="lazy" class="airport-image">
                </div>
                
                <div class="card airport-card">
                    <div class="card-content">
                        <h3 class="airport-name"><strong>UNTT</strong></h3>
                        <p class="airport-description">{{ __('Томск (Богашёво)<br>Федеральный аэропорт') }}</p>
                    </div>
                    <img src="{{ asset('images/UNTT_TERMINAL_1.jpg') }}" alt="UNTT Airport" loading="lazy" class="airport-image">
                </div>
                
                <div class="card airport-card">
                    <div class="card-content">
                        <h3 class="airport-name"><strong>UNEE</strong></h3>
                        <p class="airport-description">{{ __('Кемерово<br>Региональный аэропорт') }}</p>
                    </div>
                    <img src="{{ asset('images/UNEE_TERMINAL_1.png') }}" alt="UNEE Airport" loading="lazy" class="airport-image">
                </div>
                
                <div class="card airport-card">
                    <div class="card-content">
                        <h3 class="airport-name"><strong>UNWW</strong></h3>
                        <p class="airport-description">{{ __('Новокузнецк (Спиченково)<br>Региональный аэропорт') }}</p>
                    </div>
                    <img src="{{ asset('images/UNWW_TERMINAL.jpg') }}" alt="UNWW Airport" loading="lazy" class="airport-image">
                </div>
                
                <div class="card airport-card">
                    <div class="card-content">
                        <h3 class="airport-name"><strong>UNSS</strong></h3>
                        <p class="airport-description">{{ __('Стрежевой<br>Местный аэропорт') }}</p>
                    </div>
                    <img src="{{ asset('images/UNSS_TERMINAL.jpg') }}" alt="UNSS Airport" loading="lazy" class="airport-image">
                </div>
            </div>
        </section>

        <!-- Контакты -->
        <section class="section">
            <h2 class="section-title">{{ __('Полезная информация') }}</h2>
            <div class="cards-grid">
                <div class="card info-card">
                    <h3 class="card-title">{{ __('Контакты') }}</h3>
                    <p class="card-text">{{ __('Для связи с нами, пожалуйста, используйте адрес электронной почты:') }} <a href="mailto:unnt-fir@outlook.com" class="email-link">unnt-fir@outlook.com</a></p>
                </div>
                
                <div class="card info-card">
                    <h3 class="card-title">{{ __('Службы поддержки') }}</h3>
                    <p class="card-text">{{ __('Наши диспетчеры всегда готовы помочь. Для получения помощи присоединяйтесь к нашему Discord-серверу.') }}</p>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
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
            
            // Save language preference
            fetch('/set-locale', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ locale: lang })
            });
        }

        // Set default language
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll to top button
            const scrollToTopBtn = document.getElementById("scrollToTopBtn");
            
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    scrollToTopBtn.classList.add('visible');
                } else {
                    scrollToTopBtn.classList.remove('visible');
                }
            });
            
            scrollToTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Mobile menu
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const navContainer = document.querySelector('.nav-container');

            mobileMenuBtn.addEventListener('click', () => {
                navContainer.classList.toggle('mobile-active');
                
                if (navContainer.classList.contains('mobile-active')) {
                    mobileMenuBtn.textContent = '✕';
                } else {
                    mobileMenuBtn.textContent = '☰';
                }
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth > 768) {
                    navContainer.classList.remove('mobile-active');
                    mobileMenuBtn.textContent = '☰';
                }
            });
        });
    </script>
@endsection