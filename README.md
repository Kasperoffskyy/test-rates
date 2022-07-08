Установка:

Git clone, docker-compose up -d в папке docker
composer install в контейнере с rate-app
.env.example => .env в контейнере с rate-app
php artisan migrate в контейнере с rate-app
php artisan config:cache в контейнере с rate-app
Использование:

Получить курс по дате, например для USD на 01.01.2022

GET - http://localhost:8888/api/exchange-rates/by-date/01.01.2022/USD

Получить курс по дате, например для USD на 01.01.2022 И СОХРАНИТЬ

GET - http://localhost:8888/api/exchange-rates/by-date/01.01.2022/USD?save=true

Получить все ранее сохраненные курсы на 01.01.2022

GET - http://localhost:8888/api/exchange-rates/by-date/01.01.2022

Добавить примечание к курсу:

POST - http://localhost:8888/api/exchange-rates/add-note/{id}

note: текст текст

( где {id} - id из списка сохраненных курсов, note (post параметр) - примечание )
