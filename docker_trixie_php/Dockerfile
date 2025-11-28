FROM php:8.4-apache-trixie
# 1. Install OS-level build dependencies for PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libcurl4-openssl-dev \
    libicu-dev 

# 2. Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
       pdo \
       pdo_mysql \
       mysqli \
       mbstring \
       zip \
       xml \
       curl \
       gd \
       intl

# 3. Enable necessary Apache modules
RUN a2enmod rewrite

WORKDIR /var/www/html

COPY ./www/ /var/www/html

RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80