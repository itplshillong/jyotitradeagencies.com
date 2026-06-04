<?php
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();
$adminPageTitle = 'SEO Settings';
$db = getDB();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $keys = ['meta_title_home','meta_desc_home','meta_keywords','google_analytics','og_image'];
    foreach ($keys as $key) {
        $val = sanitize($_POST[$key] ?? '');
        $db->prepare('UPDATE settings SET setting_val=? WHERE setting_key=?')->execute([$val, $key]);
    }
    // If google_analytics key doesn't exist yet (older installs), insert it
    $msg = '<div class="alert alert-success auto-dismiss">SEO settings saved.</div>';
}

$settings = [];
$rows = $db->query("SELECT setting_key, setting_val FROM settings WHERE setting_key IN ('meta_title_home','meta_desc_home','meta_keywords','google_analytics','og_image')")->fetchAll();
foreach ($rows as $r) $settings[$r['setting_key']] = $r['setting_val'];

include __DIR__ . '/includes/header.php';
?>

<?= $msg ?>

<div class="admin-card" style="max-width:750px">
  <div class="admin-card-header"><h6 class="mb-0 fw-bold">SEO Settings</h6></div>
  <div class="admin-card-body">
    <form method="post">
      <?= csrf_field() ?>
      <div class="mb-4">
        <label class="form-label">Home Page Meta Title</label>
        <input type="text" name="meta_title_home" class="form-control" maxlength="255" value="<?= e($settings['meta_title_home'] ?? '') ?>">
        <small class="text-muted">Recommended: 50–60 characters</small>
      </div>
      <div class="mb-4">
        <label class="form-label">Home Page Meta Description</label>
        <textarea name="meta_desc_home" class="form-control" rows="3" maxlength="500"><?= e($settings['meta_desc_home'] ?? '') ?></textarea>
        <small class="text-muted">Recommended: 150–160 characters</small>
      </div>
      <div class="mb-4">
        <label class="form-label">Meta Keywords</label>
        <input type="text" name="meta_keywords" class="form-control" maxlength="500" value="<?= e($settings['meta_keywords'] ?? '') ?>">
        <small class="text-muted">Comma-separated keywords</small>
      </div>
      <div class="mb-4">
        <label class="form-label">Social Share Image URL <small class="text-muted">(og:image)</small></label>
        <input type="url" name="og_image" class="form-control" maxlength="500" value="<?= e($settings['og_image'] ?? '') ?>" placeholder="https://yourdomain.com/assets/images/social-banner.jpg">
        <small class="text-muted">Recommended: 1200×630 px JPG/PNG. Used when the site is shared on WhatsApp, LinkedIn, Facebook. Leave blank to use the logo.</small>
      </div>
      <div class="mb-4">
        <label class="form-label">Google Analytics Tracking Code</label>
        <textarea name="google_analytics" class="form-control" rows="4" placeholder="<!-- Paste your full GA4 <script> tag here -->"><?= e($settings['google_analytics'] ?? '') ?></textarea>
        <small class="text-muted">Paste the entire &lt;script&gt; snippet from Google Analytics → Admin → Data Streams → Tagging Instructions.</small>
      </div>
      <button type="submit" class="btn-primary-admin"><i class="fas fa-save me-2"></i>Save SEO Settings</button>
    </form>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
