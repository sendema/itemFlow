## Что было реализовано:
- CRUD операции с продуктами
    - Создание, чтение, обновление и удаление продуктов
    - Local Scope для фильтрации доступных продуктов (status = available)
    - Soft Deletes для продуктов
- API для получения списка продуктов
- Система ролей (администратор/пользователь)
- Email уведомления через очередь
- Webhook интеграция
- Валидация данных
- Eloquent Model с кастомным скоупом

## Дополнительно

- Написание тестов
- Упаковка в контейнеры

## Установка и запуск

1. Клонировать репозиторий
```bash
git clone git@github.com:sendema/itemFlow.git
```
2. Настроить `.env`
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=dbname
DB_USERNAME=dbuser
DB_PASSWORD=pwd
DB_ROOT_PASSWORD=dbpwd

QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.yandex.ru
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"

PRODUCTS_EMAIL=
PRODUCT_WEBHOOK_URL=https://webhook.site/0fabc4e7-f2d0-4453-aaee-162878f6707c
```

3. Собрать и запустить контейнеры
```bash
docker-compose up --build -d
```

4. Войти в PHP контейнер
```bash
docker-compose exec php-fpm bash
```

5. Установить зависимости и выполнить миграции
```bash
composer install
php artisan migrate
```
6. Запустить очередь
```bash
php artisan queue:work
```

7. Запустить планировщик задач
```bash
php artisan schedule:work
```

## Дополнительные возможности
### Тесты
```bash
php artisan test
```
