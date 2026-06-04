<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<meta name="keywords" content="<?= e($metaKeywords) ?>">
<meta name="robots" content="index, follow">
<link rel="canonical" href="<?= e(SITE_URL . strtok($_SERVER['REQUEST_URI'], '?')) ?>">

<!-- Open Graph (Facebook, WhatsApp, LinkedIn) -->
<meta property="og:type"        content="website">
<meta property="og:url"         content="<?= e(SITE_URL . strtok($_SERVER['REQUEST_URI'], '?')) ?>">
<meta property="og:title"       content="<?= e($metaTitle) ?>">
<meta property="og:description" content="<?= e($metaDesc) ?>">
<meta property="og:image"       content="<?= e($ogImage) ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name"   content="<?= e($companyName) ?>">
<meta property="og:locale"      content="en_IN">

<!-- Twitter Card -->
<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:title"       content="<?= e($metaTitle) ?>">
<meta name="twitter:description" content="<?= e($metaDesc) ?>">
<meta name="twitter:image"       content="<?= e($ogImage) ?>">

<!-- JSON-LD: Organization Schema (Google Knowledge Panel) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": <?= json_encode($companyName, JSON_UNESCAPED_UNICODE) ?>,
  "url": <?= json_encode(SITE_URL, JSON_UNESCAPED_UNICODE) ?>,
  "logo": <?= json_encode(SITE_URL . '/assets/images/logo.svg', JSON_UNESCAPED_UNICODE) ?>,
  "description": <?= json_encode($metaDesc, JSON_UNESCAPED_UNICODE) ?>,
  "foundingYear": "1960",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": <?= json_encode($companyPhone, JSON_UNESCAPED_UNICODE) ?>,
    "contactType": "customer service",
    "email": <?= json_encode($companyEmail, JSON_UNESCAPED_UNICODE) ?>,
    "availableLanguage": "English"
  },
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "India",
    "addressCountry": "IN"
  }
}
</script>

<!-- Preconnect -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome 6 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<!-- AOS Animations -->
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="<?= SITE_URL ?>/assets/css/style.css" rel="stylesheet">

<!-- Favicon -->
<link rel="icon" type="image/svg+xml" href="<?= SITE_URL ?>/assets/images/favicon.svg">
</head>
<body>

<!-- ===== TOP BAR ===== -->
<div class="topbar d-none d-md-block">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center py-2">
      <div class="topbar-left">
        <span class="me-4"><i class="fas fa-phone me-2"></i><?= e($companyPhone) ?></span>
        <span><i class="fas fa-envelope me-2"></i><?= e($companyEmail) ?></span>
      </div>
      <div class="topbar-right">    
        <span class="badge-global"><i class="fas fa-globe me-1"></i>Since 1960</span>
      </div>
    </div>
  </div>
</div>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="mainNav">
  <div class="container">
    <a class="navbar-brand" href="<?= SITE_URL ?>/">
      <div class="brand-wrapper">
        <div class="brand-icon"><img src="<?= SITE_URL ?>/assets/images/logo.svg" alt="<?= e($companyName) ?>" height="48" style="display:block"></div>
        <div>
          <div class="brand-name"><?= e($companyName) ?></div>
          <div class="brand-tagline">Veterinary One Stop Solutions</div>
        </div>
      </div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
        <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>" href="<?= SITE_URL ?>/">Home</a></li>
        <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '' ?>" href="<?= SITE_URL ?>/about.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active' : '' ?>" href="<?= SITE_URL ?>/products.php">Products</a></li>
        <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'industries.php' ? 'active' : '' ?>" href="<?= SITE_URL ?>/industries.php">Industries We Serve</a></li>
        <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : '' ?>" href="<?= SITE_URL ?>/contact.php">Contact Us</a></li>
        <li class="nav-item ms-lg-2">
          <a class="btn btn-quote" href="<?= SITE_URL ?>/quote.php">
            <i class="fas fa-file-alt me-1"></i>Get A Quote
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
