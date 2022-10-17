FROM php:8.1.11-cli-bullseye

# Copy over our PHP libraries/runtime
COPY ./src /opt/executor

# Set working directory to our /opt/executor location
WORKDIR /opt/executor

# Install composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y git zip unzip

RUN composer install