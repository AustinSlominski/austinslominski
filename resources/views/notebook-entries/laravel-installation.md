## Laravel Installation

Laravel requires [Composer][1], which is a dependency manager. You can install Composer by running this command in the terminal:

```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === 'aa96f26c2b67226a324c27919f1eb05f21c248b987e6195cad9690d5c1ff713d53020a02ac8c217dbf90a7eacc9d141d') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

Now, require the laravel installer package in composer:

```
composer global require "laravel/installer"
```

You might run into file permissions problems if you originally ran some of your composer install commands using sudo, or root. You will want to revert those permissions with this line in that case.

```
sudo chown -R $USER $HOME/.composer
```

Now, add composer to your path by running this command in the terminal, so that the laravel command is accessible. 

```
export PATH="$PATH:~/.composer/vendor/bin"
```

Now, you can install a Laravel site using the command `laravel new NAME`.

[1]: https://getcomposer.org