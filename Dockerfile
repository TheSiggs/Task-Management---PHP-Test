FROM php:8.2-cli-alpine
WORKDIR /var/www/html

RUN \
    # Install Composer and its dependencies
    apk add --no-cache unzip && \
    curl --silent https://raw.githubusercontent.com/composer/getcomposer.org/70527179915d55b3811bebaec55926afd331091b/web/installer | php -- --2 --quiet && \
    mv composer.phar /usr/local/bin/composer && \
    # Change UID and GID of Apache to Docker user UID/GID
    # This prevents file ownership issues, mostly during local development
    echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories && \
    apk --no-cache add shadow && \
    usermod -u 1000 www-data


# Install autoconf, linux-headers, and other build dependencies
RUN apk add --no-cache $PHPIZE_DEPS linux-headers \
    && pecl install xdebug-3.3.1 \
    && docker-php-ext-enable xdebug

# Configure Xdebug (adjust according to your needs)
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.log=/tmp/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini


# Set the PHP_IDE_CONFIG environment variable to specify the server name
ENV PHP_IDE_CONFIG="serverName=PHPSTORM"


# Run as the unpriviledged www-data user
USER www-data:www-data

ENTRYPOINT [""]
