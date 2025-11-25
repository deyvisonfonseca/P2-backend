#!/bin/bash

# Script de inicialização do Laravel no Docker

echo "🚀 Iniciando setup do Laravel..."

# Se composer.json não existir, criar um projeto Laravel básico
if [ ! -f composer.json ]; then
    echo "📦 Instalando Laravel via composer..."
    composer create-project laravel/laravel --prefer-dist --no-interaction temp_laravel
    
    # Copiar arquivos do Laravel instalado
    cp -r temp_laravel/* ./
    cp -r temp_laravel/.[^.]* ./
    rm -rf temp_laravel
fi

# Instalar dependências
echo "📚 Instalando dependências..."
composer install --no-interaction --quiet

# Gerar APP_KEY
echo "🔑 Gerando APP_KEY..."
php artisan key:generate --force --quiet

# Aguardar banco de dados estar pronto
echo "⏳ Aguardando banco de dados..."
sleep 10

# Executar migrations
echo "🗄️ Executando migrations..."
php artisan migrate --force --quiet 2>/dev/null || true

echo "✅ Setup concluído! Iniciando servidor..."

# Manter o container rodando
exec php artisan serve --host=0.0.0.0
