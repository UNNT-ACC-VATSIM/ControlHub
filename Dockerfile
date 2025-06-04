FROM php:8.2-fpm

# Установим необходимые системные пакеты, включая git, curl, unzip и nodejs (одним слоем)
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    libzip-dev libpq-dev gnupg ca-certificates && \
    # Установка Node.js 20.x
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    # Установка расширений PHP
    docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd && \
    # Проверка установленных версий
    git --version && node --version && npm --version

# Установка Composer (официальный способ)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
