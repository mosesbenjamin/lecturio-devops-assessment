FROM php:8.0-apache

# Install Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug


# Install necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update && apt-get install -y \
    libsasl2-dev \
    libsasl2-2 \
    libsasl2-modules-gssapi-mit \
    pkg-config \
    libssl-dev \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# # Install MongoDB PHP extension
# RUN pecl install mongodb && \
#     docker-php-ext-enable mongodb
# # echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini

# Copy Apache configuration file
COPY custom.conf /etc/apache2/sites-available/000-default.conf

# Copy PHP application files
COPY src/ /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# Enable Apache modules
RUN a2enmod rewrite

CMD ["apache2-foreground"]





# FROM php:7.0.33-apache

# # Install Xdebug
# RUN pecl install xdebug-2.5.5 \
#     && docker-php-ext-enable xdebug

# # # Install the PHP extensions needed to connect to MySQL and MongoDB
# # RUN docker-php-ext-install mysqli mongodb

# # Set the server name to localhost
# RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# # Copy custom Apache configuration file to the container
# COPY custom.conf /etc/apache2/sites-available/000-default.conf

# # Enable mod_rewrite and mod_headers in Apache
# RUN a2enmod rewrite headers

# # Set the document root to /var/www/html/public
# ENV APACHE_DOCUMENT_ROOT /var/www/html
# RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
#     && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# # Add www-data user to the root group
# RUN usermod -aG root www-data

# # Copy the PHP application to the container
# COPY src/ /var/www/html

# # Set the owner and group for the application files
# RUN chown -R www-data:root /var/www/html \
#     && chmod -R 775 /var/www/html

# # Expose port 80
# EXPOSE 80


# # Base image
# FROM php:7.0.33-apache

# # Enable Xdebug
# RUN pecl install xdebug-2.5.5 && docker-php-ext-enable xdebug

# # Copy custom Apache configuration file
# COPY custom.conf /etc/apache2/sites-available/000-default.conf

# # Enable Apache modules
# RUN a2enmod rewrite && a2enmod headers && a2enmod remoteip && a2enmod expires && a2enmod setenvif

# # Set proper permissions to access / on the server
# RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# # Create php apache server configuration to ensure Options directive allows server-generated directory indexes
# RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/Options Indexes FollowSymLinks/Options Indexes FollowSymLinks MultiViews/' /etc/apache2/apache2.conf

# # Start Apache
# CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]



# FROM php:7.0.33-apache

# # Install Xdebug
# RUN pecl install xdebug-2.5.5 \
#     && docker-php-ext-enable xdebug

# # Set the server name to localhost
# RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# # Copy custom Apache configuration file to the container
# COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# # Enable mod_rewrite and mod_headers in Apache
# RUN a2enmod rewrite headers

# # Set the document root to /var/www/html/public
# ENV APACHE_DOCUMENT_ROOT /var/www/html/public
# RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
#     && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# # Add www-data user to the root group
# RUN usermod -aG root www-data

# # Copy the PHP application to the container
# COPY src/ /var/www/html/public/

# # Set the owner and group for the application files
# RUN chown -R www-data:root /var/www/html/public \
#     && chmod -R 775 /var/www/html/public

# # Expose port 80
# EXPOSE 80
