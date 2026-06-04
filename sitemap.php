<?php
/**
 * Dynamic XML Sitemap — served at /sitemap.xml via .htaccess rewrite
 * Includes all public pages + active product categories.
 */
require_once __DIR__ . '/config/database.php';

header('Content-Type: application/xml; charset=UTF-8');
header('X-Robots-Tag: noindex'); // Don't index the sitemap itself

$base = rtrim(SITE_URL, '/');

// Static pages with their change frequency and priority
$staticPages = [
    ['url' => $base . '/',               'changefreq' => 'weekly',  'priority' => '1.0'],
    ['url' => $base . '/about.php',      'changefreq' => 'monthly', 'priority' => '0.8'],
    ['url' => $base . '/products.php',   'changefreq' => 'weekly',  'priority' => '0.9'],
    ['url' => $base . '/industries.php', 'changefreq' => 'monthly', 'priority' => '0.7'],
    ['url' => $base . '/contact.php',    'changefreq' => 'monthly', 'priority' => '0.6'],
    ['url' => $base . '/quote.php',      'changefreq' => 'monthly', 'priority' => '0.8'],
];

// Dynamic product category pages (anchor links on products.php)
$categories = [];
try {
    $categories = getDB()
        ->query('SELECT slug, updated_at FROM product_categories WHERE is_active=1 ORDER BY sort_order ASC')
        ->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // Silently skip if DB unavailable
}

$lastmod = date('Y-m-d');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

<?php foreach ($staticPages as $page): ?>
  <url>
    <loc><?= htmlspecialchars($page['url'], ENT_XML1 | ENT_QUOTES, 'UTF-8') ?></loc>
    <lastmod><?= $lastmod ?></lastmod>
    <changefreq><?= $page['changefreq'] ?></changefreq>
    <priority><?= $page['priority'] ?></priority>
  </url>
<?php endforeach; ?>

<?php foreach ($categories as $cat): ?>
  <url>
    <loc><?= htmlspecialchars($base . '/products.php#' . $cat['slug'], ENT_XML1 | ENT_QUOTES, 'UTF-8') ?></loc>
    <lastmod><?= date('Y-m-d', strtotime($cat['updated_at'])) ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
<?php endforeach; ?>

</urlset>
