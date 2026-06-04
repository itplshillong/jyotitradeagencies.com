<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/security.php';

function adminLoggedIn(): bool {
    return !empty($_SESSION['admin_id']);
}

function requireAdmin(): void {
    if (!adminLoggedIn()) {
        redirect(SITE_URL . '/admin/login.php');
    }
}

function adminUser(): array {
    return $_SESSION['admin_user'] ?? [];
}
