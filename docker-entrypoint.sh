#!/bin/bash
set -e

# データベースファイルが存在しない場合は作成
if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
    chown www-data:www-data /var/www/html/database/database.sqlite
fi

# マイグレーションを実行
php artisan migrate --force

# シードを実行
php artisan db:seed --force

# 元のコマンドを実行
exec "$@"