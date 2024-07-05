up: run-consumer, run
	@echo "Running consumer and app..."
run:
	@docker compose up -d
stop:
	@docker compose down
php:
	@docker compose exec php bash
build:
	@docker compose build
install:
	@docker compose run --rm php composer update "symfony/*" -W
	@docker compose run --rm php php bin/console doctrine:schema:create
run-consumer:
	@docker compose run --rm php php bin/console messenger:setup-transports
