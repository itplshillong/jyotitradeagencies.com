<?php
require_once dirname(__DIR__, 2) . '/config/database.php';
require_once dirname(__DIR__, 2) . '/config/security.php';

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
