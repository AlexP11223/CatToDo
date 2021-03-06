A simple ToDo app that shows [a random cat image](https://thecatapi.com/) after completing a task.

http://cattodo.herokuapp.com

Implemented using Laravel, Bootstrap.

Features:

- Shows random cat images when a task is marked as completed. 🐱
- Responsive UI, works fine on desktops and mobile.
- Swipe tasks on mobile instead of pressing the checkbox ([hammer.js](http://hammerjs.github.io/)).
- Categories (no custom categories yet).
- Add task to a category or without any categories.
- Update, delete tasks.

![](https://i.imgur.com/UIeB445.png)

![](https://i.imgur.com/H6o6EPv.png)

# Development setup

For development you can use Homestead virtual machine (via Vagrant) instead of manually installing all needed tools (PHP, web server, NPM, ...).

 1. Install [VirtualBox](https://www.virtualbox.org/wiki/Downloads) and [Vagrant](https://www.vagrantup.com/downloads.html).
 2. Install PHP (just [interpreter](http://php.net/downloads.php), server not needed) and [Composer](https://getcomposer.org/download/). Go to the project root, run `composer install` and `php vendor/bin/homestead make` (for Windows `vendor\\bin\\homestead make`), this will generate configuration file, **Homestead.yaml**.
  - Alternatively, you can follow Laravel Homestead documentation to install Homestead globally, it should not require PHP. https://laravel.com/docs/5.8/homestead
 3. Add `cattodo` and `cattodo-test` databases to **Homestead.yaml**.

     ```
     databases:
         - cattodo
         - cattodo-test
     ```
 4. Run `vagrant up`, this should download, configure and launch the virtual machine. Follow Laravel Homestead and Vagrant documentation if it fails. On Windows you may need to run it from admin cmd to avoid issues with symlinks (e.g. when installing npm packages).
 5. Use `vagrant ssh` to connect into it.
 6. Run `make env` to create `.env` file and generate `APP_KEY`.
 7. Run `make install` from the project dir in Vagrant (`cd code` by default) to install packages and run database migrations, build frontend.
 8. Add the IP and domain from **Homestead.yaml** to your **hosts** file, e.g. `192.168.10.10  cattodo.test`.
 9. Open http://cattodo.test in your web browser.

See **Makefile** for other common tasks.

# Heroku deployment

0. Register an account (free), install Heroku CLI, login, etc. https://devcenter.heroku.com/articles/getting-started-with-php
1. `heroku create`
2. 
```
heroku buildpacks:add heroku/php
heroku buildpacks:add heroku/nodejs
```
3. `heroku addons:create heroku-postgresql:hobby-dev`
4. 
```
php artisan key:generate --show
heroku config:set APP_KEY = <key generated above>
```
5. `heroku config:set LOG_CHANNEL=single`
6. `heroku config:set CAT_API_KEY=<key from https://thecatapi.com (free)>`
7. `git push heroku master`
8. `heroku run php artisan db:seed --force`
