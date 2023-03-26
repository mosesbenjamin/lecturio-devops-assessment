FROM php:8.0-apache

ARG ENVIRONMENT

RUN if [ "${ENVIRONMENT}" = "dev" ]; then \
    # Install Xdebug
    pecl install xdebug && docker-php-ext-enable xdebug; \
    fi

# Install necessary PHP extensions for mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install MongoDB PHP extension
RUN apt-get update && apt-get install -y \
    libsasl2-dev \
    libsasl2-2 \
    libsasl2-modules-gssapi-mit \
    pkg-config \
    libssl-dev
RUN pecl install mongodb && \
    docker-php-ext-enable mongodb

# Copy Apache configuration file
COPY custom.conf /etc/apache2/sites-available/000-default.conf

# Copy PHP application files
COPY src/ /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# Enable Apache modules
RUN a2enmod rewrite

CMD ["apache2-foreground"]