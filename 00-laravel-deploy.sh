# #!/usr/bin/env bash
# echo "Running composer"
# composer install --no-dev --working-dir=/var/www/html
# composer update

# echo "Generating Key..."
# php artisan key:generate --show

# echo "Clearing caches..."
# php artisan optimize:clear

# echo "Caching config..."
# php artisan config:cache

# echo "Caching routes..."
# php artisan route:cache

# echo "Running migrations..."
# php artisan migrate --force
#!/bin/sh

# Gerar chave de aplicação e exibir
php artisan key:generate --show

# Limpar cache de otimização
php artisan optimize:clear

# Limpar cache de configuração
php artisan config:cache

# Criar cache de rotas
php artisan route:cache

# Executar migrações com refresh e seed (recriar o banco de dados e adicionar dados de teste)
php artisan migrate:fresh --seed