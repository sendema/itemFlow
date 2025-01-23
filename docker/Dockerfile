# Базовый образ PHP с FPM
FROM php:8.2-fpm

# Устанавливаем необходимые системные зависимости
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    git \
    supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        mbstring \
        pdo \
        pdo_mysql \
        xml \
        bcmath \
        zip \
        opcache

# Устанавливаем Redis расширение
RUN pecl install redis && docker-php-ext-enable redis

# Устанавливаем Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Копируем локальные настройки PHP
COPY ./conf/php/php.ini /usr/local/etc/php/php.ini

# Копируем конфигурацию supervisor
COPY ./conf/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Настраиваем рабочую директорию
WORKDIR /var/www/html

# Создаем пользователя для запуска приложения
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www

# Меняем владельца директории
RUN chown -R www:www /var/www

# Переключаемся на пользователя www
USER www