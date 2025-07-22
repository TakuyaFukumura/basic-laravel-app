# Laravel Hello World アプリケーション

Laravelスタイルで作成された、SQLiteデータベースから「Hello, World!」メッセージを表示するシンプルなWebアプリケーションです。

## 概要

このアプリケーションは以下の機能を提供します：

- SQLiteデータベースからメッセージを取得
- データベース接続エラー時の適切なエラーハンドリング
- Docker環境での実行サポート
- レスポンシブなWebデザイン

## 技術仕様

- **PHP**: 8.3+
- **データベース**: SQLite
- **Webサーバー**: Apache (Docker環境)
- **フレームワーク**: Laravel風のMVCアーキテクチャ

## 実行方法

### 1. Dockerを使用した実行（推奨）

```bash
# リポジトリをクローン
git clone https://github.com/TakuyaFukumura/basic-laravel-app.git
cd basic-laravel-app

# Dockerコンテナを起動
docker-compose up -d

# ブラウザで確認
# http://localhost:8080 にアクセス
```

### 2. PHPの組み込みサーバーでの実行

```bash
# publicディレクトリに移動
cd public

# PHPサーバーを起動
php -S localhost:8000 index.php

# ブラウザで確認
# http://localhost:8000 にアクセス
```

### 3. アプリケーションのテスト

```bash
# テストスクリプトを実行
./test-app.sh
```

## ディレクトリ構成

```
basic-laravel-app/
├── app/
│   ├── Http/Controllers/        # コントローラー
│   ├── Models/                  # モデル
│   └── Providers/               # サービスプロバイダー
├── database/
│   ├── migrations/              # データベースマイグレーション
│   ├── seeders/                 # データベースシーダー
│   └── database.sqlite          # SQLiteデータベースファイル
├── public/
│   ├── index.php               # エントリーポイント
│   └── simple-bootstrap.php    # シンプルなブートストラップ
├── resources/
│   └── views/                  # ビューテンプレート
├── routes/
│   └── web.php                 # Webルート定義
├── docker-compose.yml          # Docker Compose設定
├── Dockerfile                  # Docker設定
└── README.md                   # このファイル
```

## 動作確認

正常動作時：
- **表示**: 「Hello, World!」
- **背景色**: グラデーション（紫～青）

エラー時：
- **表示**: 「Error」（赤色）
- **発生条件**: データベース接続エラー、データ取得失敗時

## 開発について

### データベースの初期化

アプリケーションは初回実行時に自動的に：
1. SQLiteデータベースファイルを作成
2. `messages`テーブルを作成
3. 初期データ「Hello, World!」を挿入

### エラーハンドリング

- データベース接続失敗
- SQLクエリ実行エラー
- データが存在しない場合

上記のいずれの場合でも「Error」メッセージを表示し、アプリケーションがクラッシュしないように設計されています。

## バージョン情報

- **バージョン**: 1.0.0
- **リリース日**: 2024年7月
- **セマンティックバージョニング**: 採用

## ライセンス

MIT License

## 貢献

プルリクエストやイシューの報告を歓迎します。日本語でのコミュニケーションを推奨します。
