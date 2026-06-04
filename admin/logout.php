<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/security.php';
require_once __DIR__ . '/includes/auth.php';

session_unset();
session_destroy();
redirect(SITE_URL . '/admin/login.php');
