<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= isset($adminPageTitle) ? e($adminPageTitle) . ' — Admin' : 'Admin Panel' ?> | Jyoti Trade Agencies</title>
<meta name="robots" content="noindex,nofollow">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
<link href="<?= SITE_URL ?>/admin/assets/css/admin.css" rel="stylesheet">
</head>
<body>

<!-- Sidebar -->
<nav class="admin-sidebar" id="adminSidebar">
  <div class="sidebar-brand">
    <div class="sidebar-brand-icon"><i class="fas fa-paw"></i></div>
    <div>
      <div class="sidebar-brand-name">Jyoti Trade</div>
      <div class="sidebar-brand-sub">Admin Panel</div>
    </div>
  </div>
  <div class="sidebar-nav">
    <div class="sidebar-section-label">Main</div>
    <a href="<?= SITE_URL ?>/admin/dashboard.php" class="sidebar-link <?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : '' ?>">
      <i class="fas fa-gauge"></i> Dashboard
    </a>

    <div class="sidebar-section-label mt-2">Content</div>
    <a href="<?= SITE_URL ?>/admin/banners.php" class="sidebar-link <?= basename($_SERVER['PHP_SELF']) === 'banners.php' ? 'active' : '' ?>">
      <i class="fas fa-images"></i> Banners
    </a>
    <a href="<?= SITE_URL ?>/admin/products.php" class="sidebar-link <?= basename($_SERVER['PHP_SELF']) === 'products.php' ? 'active' : '' ?>">
      <i class="fas fa-boxes-stacked"></i> Product Categories
    </a>

    <div class="sidebar-section-label mt-2">Inquiries</div>
    <a href="<?= SITE_URL ?>/admin/inquiries.php" class="sidebar-link <?= basename($_SERVER['PHP_SELF']) === 'inquiries.php' ? 'active' : '' ?>">
      <i class="fas fa-envelope"></i> Contact Inquiries
    </a>
    <a href="<?= SITE_URL ?>/admin/quotes.php" class="sidebar-link <?= basename($_SERVER['PHP_SELF']) === 'quotes.php' ? 'active' : '' ?>">
      <i class="fas fa-file-alt"></i> Quote Requests
    </a>

    <div class="sidebar-section-label mt-2">Configuration</div>
    <a href="<?= SITE_URL ?>/admin/seo.php" class="sidebar-link <?= basename($_SERVER['PHP_SELF']) === 'seo.php' ? 'active' : '' ?>">
      <i class="fas fa-search"></i> SEO Settings
    </a>
    <a href="<?= SITE_URL ?>/admin/settings.php" class="sidebar-link <?= basename($_SERVER['PHP_SELF']) === 'settings.php' ? 'active' : '' ?>">
      <i class="fas fa-gear"></i> Settings
    </a>

    <div class="sidebar-section-label mt-2">Account</div>
    <a href="<?= SITE_URL ?>/" target="_blank" class="sidebar-link">
      <i class="fas fa-external-link-alt"></i> View Website
    </a>
    <a href="<?= SITE_URL ?>/admin/logout.php" class="sidebar-link" style="color:#F87171">
      <i class="fas fa-right-from-bracket"></i> Logout
    </a>
  </div>
</nav>

<!-- Main -->
<div class="admin-main">
  <!-- Topbar -->
  <div class="admin-topbar">
    <div class="d-flex align-items-center gap-3">
      <button class="btn btn-sm btn-light d-md-none" id="sidebarToggle"><i class="fas fa-bars"></i></button>
      <h6 class="mb-0 fw-600" style="font-weight:600"><?= isset($adminPageTitle) ? e($adminPageTitle) : 'Dashboard' ?></h6>
    </div>
    <div class="d-flex align-items-center gap-3">
      <span class="text-muted small">Welcome, <strong><?= e(adminUser()['full_name'] ?? 'Admin') ?></strong></span>
    </div>
  </div>
  <div class="admin-content">
