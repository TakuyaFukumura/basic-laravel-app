FROM php:8.3-apache

# 必要なPHP拡張をインストール
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# ワーキングディレクトリを設定
WORKDIR /var/www/html

# アプリケーションファイルをコピー
COPY . /var/www/html

# Laravelのpublicディレクトリがドキュメントルートになるように設定
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Apacheのmod_rewriteを有効化
RUN a2enmod rewrite

# 権限設定
RUN chown -R www-data:www-data /var/www/html \
    && mkdir -p /var/www/html/database \
    && chown -R www-data:www-data /var/www/html/database

# 環境変数
ENV APP_ENV=production
ENV APP_DEBUG=false

# ポート80を公開
EXPOSE 80

# Apacheを起動
CMD ["apache2-foreground"]