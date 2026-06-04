<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/security.php';

$companyName  = getSetting('company_name') ?: 'Jyoti Trade Agencies';
$companyPhone = getSetting('phone');
$companyEmail = getSetting('email');
$companyAddr  = getSetting('address');

// Social share image — fallback to logo if not set in admin SEO
$ogImage = getSetting('og_image') ?: SITE_URL . '/assets/images/logo.svg';

// Page-level SEO defaults (overridden per-page)
if (!isset($metaTitle))    $metaTitle    = getSetting('meta_title_home');
if (!isset($metaDesc))     $metaDesc     = getSetting('meta_desc_home');
if (!isset($metaKeywords)) $metaKeywords = getSetting('meta_keywords');
