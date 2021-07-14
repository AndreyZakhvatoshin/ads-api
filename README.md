# API создания, обновления и открутки рекламы
## Установка

```sh
git clone https://github.com/AndreyZakhvatoshin/ads-api.git
cd ads-api
```

## Настройка

```sh
composer install
создать .env файл на основе файла .env.example

```

## Docker
Управление docker - контейнерами осуществляется с помощью Makefile

## Makefile

| Команда           | Процессы                                                     |
| ----------------- | ------------------------------------------------------------ |
| make docker-up    | docker-compose up -d                                         |
| make docker-down  | docker-compose down                                          |
| make docker-build | docker-compose up --build -d                                 |

## Создание таблицы
Дамп таблицы находится в корневой папке проекта dump.sql

## Запросы к api
| Метод | url                       | аргументы                  |
| ----- | ------------------------- | -------------------------- |
| GET   | /ads/relevant             |                            |
| POST  | /ads                      | text, price, limit, banner |
| POST  | /ads/{id:\d+}             | id - id записи             |
