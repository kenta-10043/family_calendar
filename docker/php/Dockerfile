FROM php:8.4-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
    && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
    && docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update

# ホスト側のユーザー/グループIDを受け取る
ARG USER_ID=1000
ARG GROUP_ID=1000

# ホストと同じUID/GIDでappuserを作成
RUN groupadd -g ${GROUP_ID} appuser \
    && useradd -m -u ${USER_ID} -g appuser appuser

# 作業ディレクトリ設定
WORKDIR /var/www

# 実行ユーザーをappuserに切り替え
USER appuser
