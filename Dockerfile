# Base image
FROM php:7

# Install dependencies
RUN apt-get update -y && apt-get install -y openssl zip unzip git

RUN docker-php-ext-install pdo_mysql

# Get & Install Composer in path
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring

# Set working dirs
WORKDIR /app
COPY . /app

# Install composer packages
RUN composer install

# Run php development server
CMD php artisan serve --host=0.0.0.0 --port=8181
EXPOSE 8181