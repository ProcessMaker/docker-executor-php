FROM php:7.3.33-cli-buster

# Copy over our PHP libraries/runtime
COPY ./src /opt/executor

# Set working directory to our /opt/executor location
WORKDIR /opt/executor

# Install composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN echo "deb https://archive.debian.org/debian buster main" > /etc/apt/sources.list

RUN apt-get update && apt-get install -y git zip unzip

# Download and set the bundle
RUN curl -kLo /usr/local/share/cacert.pem https://curl.se/ca/cacert.pem
ENV CURL_CA_BUNDLE=/usr/local/share/cacert.pem
ENV SSL_CERT_FILE=/usr/local/share/cacert.pem

# Apply to PHP
RUN echo "openssl.cafile=/usr/local/share/cacert.pem" >> /usr/local/etc/php/php.ini \
    && echo "curl.cainfo=/usr/local/share/cacert.pem" >> /usr/local/etc/php/php.ini

RUN composer install
