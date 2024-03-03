#!/bin/bash

# Ожидание доступности базы данных
# shellcheck disable=SC2164
cd /var/www/html/project
/var/www/html/project/wait-for-it.sh db:5432 --timeout=30s

# Выполнение миграции базы данных
php artisan migrate
php artisan db:seed
# Бесконечный цикл для удержания контейнера активным
apache2-foreground

