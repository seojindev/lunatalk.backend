FROM ubuntu:latest
LABEL maintainer="lunatalk.dev <lunatalk.dev@gmail.com>"

ENV DEBIAN_FRONTEND noninteractive
ENV LC_ALL=C.UTF-8

ARG OS_LOCALE

ENV TZ=Asia/Seoul

EXPOSE 80
EXPOSE 43380
EXPOSE 9000

ADD ./.docker/entrypoint.sh /usr/local/bin/entrypoint.sh
ADD ./.docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

RUN apt-get update

# System.. apt install
RUN apt-get install -y \
    apt-utils \
    language-pack-ko \
    tzdata \
    net-tools \
    curl \
    vim \
    iputils-ping \
    unzip

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN locale-gen ko_KR.UTF-8
RUN localedef -f UTF-8 -i ko_KR ko_KR.UTF-8

RUN apt-get install -y software-properties-common
RUN add-apt-repository ppa:ondrej/php
RUN apt-get update

# Developer apt install
RUN apt-get install -y \
    git \
    mariadb-client \
    nginx \
    php7.4 \
    php7.4-common \
    php7.4-cli \
    libphp7.4-embed \
    php7.4-bz2 \
    php7.4-mbstring \
    php7.4-zip \
    php7.4-curl \
    php7.4-xml \
    php7.4-gd \
    php7.4-fpm \
    php7.4-mysql

RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN /bin/bash /usr/local/bin/entrypoint.sh

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN chown www-data:www-data /var/www
ADD ./.docker/nginx_default /etc/nginx/sites-available/default
