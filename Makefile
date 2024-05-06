RUN_PHP = @docker compose run --rm php

cli:
	@docker compose run --interactive --tty --rm php sh

run: install
	$(RUN_PHP) php ./src/program.php

test: install
	$(RUN_PHP) ./vendor/bin/phpunit tests

install:
	$(RUN_PHP) composer install --quiet

phpstan:
	$(RUN_PHP) vendor/bin/phpstan