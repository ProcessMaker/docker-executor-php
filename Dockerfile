# Bring in from PHP docker image
FROM php:7.2.8-cli-stretch

# Copy over our PHP libraries/runtime
COPY ./src /opt/executor

# Set working directory to our /opt/executor location
WORKDIR /opt/executor

# Install composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Get the sdk repo if it doesn't exist
RUN apt-get update && apt-get install -y git
RUN if [ ! -d "sdk-php" ]; then git clone --depth 1 https://github.com/ProcessMaker/sdk-php.git; fi

# Get the last AWS-SDK version
RUN apt-get install zip unzip -y
RUN composer require aws/aws-sdk-php

RUN composer install