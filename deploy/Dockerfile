# Указываем базовый образ
FROM php:8.2-apache

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Устанавливаем зависимости
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    zip \
    libpq-dev

# Устанавливаем необходимые расширения PHP
RUN docker-php-ext-install pdo_pgsql zip

# Активируем модуль rewrite для Apache
RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html/project/public
RUN sed -ri -e 's!/var/www/html! ${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/! ${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER=1

COPY . /var/www/html

# Копируем файлы проекта из директории project, которая находится на одном уровне с deploy
# Устанавливаем зависимости проекта
WORKDIR /var/www/html/project
RUN mv .env.example .env

RUN export JWT_SECRET=$(openssl rand -base64 32) && echo "JWT_SECRET=$JWT_SECRET" >> /var/www/html/project/.env

RUN composer install
## Установка прав на исполнение для run.sh
RUN chmod +x /var/www/html/project/run.sh
RUN chmod +x /var/www/html/project/wait-for-it.sh
RUN chmod -R 777 /var/www/html/project/storage
# Устанавливаем права доступа к директории с базой данных
RUN chmod -R 777 /var/www/html/project/database
ENTRYPOINT ["/var/www/html/project/run.sh"]
