#!/bin/bash

echo "=== Laravel Hello World アプリケーション テスト ==="

# PHP の組み込みサーバーでテスト
echo "PHPサーバーを起動しています..."
cd /home/runner/work/basic-laravel-app/basic-laravel-app/public
php -S localhost:8000 index.php > /dev/null 2>&1 &
SERVER_PID=$!

# サーバーが起動するまで待機
sleep 2

echo "アプリケーションをテストしています..."

# curlでレスポンスをテスト
RESPONSE=$(curl -s http://localhost:8000)

if echo "$RESPONSE" | grep -q "Hello, World!"; then
    echo "✅ 成功: Hello, World! が正しく表示されました"
else
    echo "❌ エラー: 期待されるメッセージが見つかりません"
    echo "実際のレスポンス:"
    echo "$RESPONSE"
fi

# サーバーを停止
kill $SERVER_PID

echo "テスト完了"