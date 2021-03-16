.PHONY: composer
composer:
	docker-compose run --no-deps --rm php composer install

.PHONY: fixtures
fixtures:
	docker-compose run --rm php bin/console -n doctrine:fixtures:load

.PHONY: docker-up
docker-up:
	docker-compose up -d

.PHONY: docker-down
docker-down:
	docker-compose down

.PHONY: restart
restart: docker-down docker-up

.PHONY: attach
attach: docker-up
	docker-compose exec php sh

.PHONY: unit-test
unit-test:
	docker-compose run --rm --no-deps php php -d memory_limit=-1 vendor/bin/phpunit

.PHONY: cache-clear
cache-clear:
	docker-compose exec php bin/console cache:clear

.PHONY: cs-fixer
cs-fixer:
	docker-compose run --rm --no-deps php ./vendor/bin/php-cs-fixer fix --config=.php_cs --allow-risky=yes