include .$(PROJECT_ROOT_DIR)/.env
launch:
	make up
	make init
	composer migrations-migrate
init:
	docker exec poc-php composer install
update:
	docker exec poc-php composer update
pre-commit:
	composer phpstan
	composer phpcs
	composer validate-schema
	composer phpunit
pre-commit-fix:
	composer phpcbf
up:
	docker-compose up -d
down:
	docker-compose down
rebuild:
	make down
	docker-compose up -d --no-deps --build
migrations-diff:
	composer clear-cache-doc
	composer migrations-diff
empty-migration:
	composer empty-migration
cache:
	composer cache
update:
	composer migrations-migrate