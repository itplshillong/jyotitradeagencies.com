<?php
/**
 * Security helpers — CSRF, XSS, Input sanitisation
 */

if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', '1');
    ini_set('session.use_strict_mode', '1');
    ini_set('session.cookie_samesite', 'Strict');
    session_start();
}

// ── HTTP Security Headers ────────────────────────────────
// Send on every response regardless of whether session was already started
header_remove('X-Powered-By');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: geolocation=(), camera=(), microphone=()');

// ── CSRF ────────────────────────────────────────────────
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string {
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') . '">';
}

function csrf_verify(): void {
    $token = $_POST['csrf_token'] ?? '';
    if (!hash_equals(csrf_token(), $token)) {
        http_response_code(403);
        die('CSRF validation failed.');
    }
}

// ── Sanitisation ────────────────────────────────────────
function e(string $val): string {
    return htmlspecialchars($val, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function sanitize(string $val): string {
    return trim(strip_tags($val));
}

function sanitizeEmail(string $val): string {
    return filter_var(trim($val), FILTER_SANITIZE_EMAIL);
}

// ── Redirect ────────────────────────────────────────────
function redirect(string $url): void {
    // Prevent open redirect: only allow relative paths or same-host absolute URLs
    $parsed = parse_url($url);
    if (!empty($parsed['host'])) {
        $allowedHost = parse_url(SITE_URL, PHP_URL_HOST);
        if (strcasecmp($parsed['host'], $allowedHost) !== 0) {
            http_response_code(400);
            die('Invalid redirect target.');
        }
    }
    header('Location: ' . $url);
    exit;
}

// ── IP helper ───────────────────────────────────────────
// Only trust REMOTE_ADDR — HTTP_X_FORWARDED_FOR and HTTP_CLIENT_IP are
// trivially spoofable by any client and must NOT be used for security decisions.
function getClientIP(): string {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '0.0.0.0';
}
