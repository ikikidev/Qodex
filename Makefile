.PHONY: up install migrate seed down restart artisan bash logs fix-perms export-src

up:
	docker-compose up -d --build

install:
	docker exec -it qodex_app composer create-project laravel/laravel .
	docker exec -it qodex_app cp .env.example .env
	docker exec -it qodex_app php artisan key:generate

migrate:
	docker exec -it qodex_app php artisan migrate

seed:
	docker exec -it qodex_app php artisan db:seed

down:
	docker-compose down

restart:
	docker-compose down
	docker-compose up -d --build

artisan:
	docker exec -it qodex_app php artisan

bash:
	docker exec -it qodex_app bash

logs:
	docker logs -f qodex_app

fix-perms:
	docker exec -it qodex_app bash -c "chmod -R 775 storage bootstrap/cache && chown -R www-data:www-data storage bootstrap/cache"

export-src:
	docker cp qodex_app:/var/www/html ./src

filament-install:
	docker exec -it qodex_app composer require filament/filament:"^3.0"
	docker exec -it qodex_app php artisan make:filament-user
	docker exec -it qodex_app php artisan migrate

pull-code:
	docker cp qodex_app:/var/www/html/. ./src/