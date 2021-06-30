FROM php:7
WORKDIR /var/www
COPY . .
RUN apt-get update && apt-get install -y \
    && docker-php-ext-install -j$(nproc) iconv mysqli pdo_mysql  \
    && apt-get clean \
    && rm -r /var/lib/apt/lists/*