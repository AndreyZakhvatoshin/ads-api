docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build:
	docker-compose up --build -d

test:
	docker exec ads_php-fpm_1 vendor/bin/phpunit --colors=always
