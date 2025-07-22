<?php

/*
|--------------------------------------------------------------------------
| Simple Laravel-like Application Bootstrap
|--------------------------------------------------------------------------
|
| This is a minimal bootstrap for demonstration purposes.
|
*/

// Create database if it doesn't exist
$dbPath = __DIR__ . '/../database/database.sqlite';
if (!file_exists($dbPath)) {
    if (!file_exists(dirname($dbPath))) {
        mkdir(dirname($dbPath), 0755, true);
    }
    touch($dbPath);
}

// Simple database connection
try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create table if it doesn't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS messages (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        content TEXT NOT NULL
    )");
    
    // Insert initial data if table is empty
    $count = $pdo->query("SELECT COUNT(*) FROM messages")->fetchColumn();
    if ($count == 0) {
        $pdo->exec("INSERT INTO messages (content) VALUES ('Hello, World!')");
    }
    
} catch (Exception $e) {
    $pdo = null;
}

// Simple routing
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($requestUri, PHP_URL_PATH);

if ($path === '/' || $path === '') {
    // Handle root route
    try {
        if ($pdo) {
            $stmt = $pdo->query("SELECT content FROM messages LIMIT 1");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $message = $result ? $result['content'] : 'Error';
        } else {
            $message = 'Error';
        }
    } catch (Exception $e) {
        $message = 'Error';
    }
    
    // Simple view rendering
    include __DIR__ . '/../resources/views/hello.php';
} else {
    // 404 for other paths
    http_response_code(404);
    echo '404 Not Found';
}