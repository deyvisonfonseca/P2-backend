FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Instalar extensões PHP necessárias
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /app

# Copiar arquivos do projeto (com a pasta laravel temp)
COPY . /tmp/project
RUN cp -r /tmp/project/* /app/ && \
    cp -r /tmp/project/.[^.]* /app/ 2>/dev/null || true && \
    rm -rf /tmp/project

# Copiar script de inicialização
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Criar diretórios necessários
RUN mkdir -p storage/logs storage/framework/sessions storage/framework/views bootstrap/cache

# Dar permissões corretas
RUN chown -R www-data:www-data /app || true

# Expor porta 8000
EXPOSE 8000

# Comando para iniciar
CMD ["/start.sh"]
