FROM php:7.2.8-cli-stretch

# Copy over our PHP libraries/runtime
COPY ./src /opt/executor

# Set working directory to our /opt/executor location
WORKDIR /opt/executor

# Install composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN echo "deb http://archive.debian.org/debian stretch main" > /etc/apt/sources.list
RUN apt-get update && apt-get install -y git zip unzip

RUN composer install