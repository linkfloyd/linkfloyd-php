#!/usr/bin/env bash

function print_info () { echo -e "\033[0;34m *  $1 \033[0m"; }

set -e

export SYMFONY_ENV=prod

composer selfupdate

git pull origin develop
composer install --prefer-dist --no-dev --no-interaction --optimize-autoloader -v
php bin/console cache:clear --env=prod --no-debug -v

php bin/console cache:warmup --env=prod --no-debug -v

php bin/console doctrine:migrations:migrate --no-interaction

/etc/init.d/php7.0-fpm reload
/etc/init.d/nginx reload

chown -R www-data.www-data .

print_info "Done!"