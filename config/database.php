<?php
/**
 * Jyoti Trade Agencies - Database Configuration
 */

define('DB_HOST',    'localhost');
define('DB_NAME',    'jyoti_trade_agencies');
define('DB_USER',    'root');
define('DB_PASS',    '');
define('DB_CHARSET', 'utf8mb4');

define('SITE_URL',   'http://localhost/website/jyotitradeagencies.com');
define('SITE_ROOT',  dirname(__DIR__));
define('UPLOAD_DIR', SITE_ROOT . '/admin/uploads/');

function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log('DB Connection failed: ' . $e->getMessage());
            http_response_code(500);
            die('Service temporarily unavailable. Please try again later.');
        }
    }
    return $pdo;
}

function getSetting(string $key): string {
    static $cache = [];
    if (isset($cache[$key])) return $cache[$key];
    $stmt = getDB()->prepare('SELECT setting_val FROM settings WHERE setting_key = ?');
    $stmt->execute([$key]);
    $val = $stmt->fetchColumn();
    $cache[$key] = $val !== false ? $val : '';
    return $cache[$key];
}
