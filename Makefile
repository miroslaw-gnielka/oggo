USERID=$(shell id -u)
USERGROUP=$(shell id -g)

build:
	docker-compose build

up:
	docker-compose up -d

composer-install:
	docker-compose exec php composer install

migrate:
	docker-compose exec php php artisan migrate

seed-fresh:
	docker-compose exec php php artisan migrate:fresh --seed

seed:
	docker-compose exec php php artisan db:seed

db-create-file:
	touch ./src/database/database.sqlite

unit-tests:
	docker-compose exec php ./vendor/bin/phpunit

init: db-create-file build up composer-install migrate seed-fresh unit-tests
