FROM php:8.2-fpm

# Установка bash и необходимых пакетов, Node.js и PHP расширений
RUN apt-get update && apt-get install -y \
    bash curl git zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev libpq-dev gnupg ca-certificates && \
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd && \
    # Очистка кеша apt для уменьшения образа
    apt-get clean && rm -rf /var/lib/apt/lists/* && \
    git --version && node --version && npm --version

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]