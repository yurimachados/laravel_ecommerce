# Imagem base
FROM php:8.1.28


# Instalar dependências
RUN apt-get update
RUN apt-get install -y --no-install-recommends build-essential
RUN apt-get install -y --no-install-recommends default-mysql-client
RUN apt-get install -y --no-install-recommends libpng-dev
RUN apt-get install -y --no-install-recommends libjpeg62-turbo-dev
RUN apt-get install -y --no-install-recommends libfreetype6-dev
RUN apt-get install -y --no-install-recommends locales
RUN apt-get install -y --no-install-recommends zip
RUN apt-get install -y --no-install-recommends jpegoptim optipng pngquant gifsicle
RUN apt-get install -y --no-install-recommends vim
RUN apt-get install -y --no-install-recommends unzip
RUN apt-get install -y --no-install-recommends git
RUN apt-get install -y --no-install-recommends curl
RUN apt-get install -y --no-install-recommends libonig-dev
RUN apt-get install -y --no-install-recommends libzip-dev

# Limpar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensões
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip
RUN docker-php-ext-install exif
RUN docker-php-ext-install pcntl
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install gd

# Instalar composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar node.js e npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs
RUN apt-get install -y npm
RUN node -v && npm -v

# Definir diretório de trabalho
WORKDIR /var/www

# Copiar arquivos existentes para o container
COPY . /var/www

# Instalar dependências do composer
RUN composer install

# Instalar dependências do npm
RUN npm install

# Compilar assets
RUN npm run build

# Expor porta 8000
EXPOSE 8000

# Comando para iniciar o servidor
CMD php artisan serve --host=0.0.0.0 --port=8000