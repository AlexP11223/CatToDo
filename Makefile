install:
	composer install
	npm ci
	npm run dev
	php artisan migrate

clean-php:
	rm -rf vendor

clean-node:
	rm -rf node_modules

clean-frontend:
	rm -rf public/css
	rm -rf public/js
	rm -f public/mix-manifest.json

clean: clean-php clean-node clean-frontend
