<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'mini_mag');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

session_start();

function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function generateSlug($text) {
    $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
    $text = preg_replace('/[^a-z0-9-]/i', '-', $text);
    $text = preg_replace('/-+/', '-', $text);
    return strtolower(trim($text, '-'));
}

function getClientIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
?>