#!/bin/sh

# Instalar as dependências do composer
composer install --no-interaction --no-progress --no-suggest

# Executar as migrations
php artisan migrate --force

# Executar o queue worker em background
php artisan queue:work --daemon --tries=3 --queue=notificacoes,default &

# Iniciar o servidor
apache2-foreground
