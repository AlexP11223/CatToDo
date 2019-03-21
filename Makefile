env:
	cp .env.example .env
	php artisan key:generate

install:
	composer install
	npm ci
	npm run dev
	php artisan migrate

test:
	composer run-script phpunit

watch:
	npm run watch-poll

frontend:
	npm run dev

clean-php:
	rm -rf vendor

clean-node:
	rm -rf node_modules

clean-frontend:
	rm -rf public/css
	rm -rf public/js
	rm -f public/mix-manifest.json

clean: clean-php clean-node clean-frontend

clean-db:
	php artisan migrate:fresh

repl:
	php artisan tinker

ide-helper:
	php artisan clear-compiled
	php artisan ide-helper:generate
	php artisan ide-helper:meta

ide-helper-models:
	php artisan ide-helper:models --write
