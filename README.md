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
 4. Run `vagrant up`, this should download, configure and launch the virtual machine. Follow Laravel Homestead and Vagrant documentation if it fails.
 5. Use any SSH client (such as Putty on Windows) and private key (should be in **.vagrant/machines/default/virtualbox** by default, or check vagrant output) to connect into it.
