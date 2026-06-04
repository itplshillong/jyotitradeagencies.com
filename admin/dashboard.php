<?php
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();

$adminPageTitle = 'Dashboard';

$db = getDB();
$totalInquiries  = $db->query('SELECT COUNT(*) FROM inquiries')->fetchColumn();
$unreadInquiries = $db->query('SELECT COUNT(*) FROM inquiries WHERE is_read=0')->fetchColumn();
$totalQuotes     = $db->query('SELECT COUNT(*) FROM quote_requests')->fetchColumn();
$unreadQuotes    = $db->query('SELECT COUNT(*) FROM quote_requests WHERE is_read=0')->fetchColumn();
$totalCats       = $db->query('SELECT COUNT(*) FROM product_categories WHERE is_active=1')->fetchColumn();
$totalBanners    = $db->query('SELECT COUNT(*) FROM banners WHERE is_active=1')->fetchColumn();

$recentInquiries = $db->query('SELECT * FROM inquiries ORDER BY created_at DESC LIMIT 5')->fetchAll();
$recentQuotes    = $db->query('SELECT * FROM quote_requests ORDER BY created_at DESC LIMIT 5')->fetchAll();

include __DIR__ . '/includes/header.php';
?>

<!-- Stats -->
<div class="row g-4 mb-4">
  <div class="col-6 col-lg-3">
    <div class="stat-card d-flex align-items-center gap-3">
      <div class="stat-icon green"><i class="fas fa-envelope"></i></div>
      <div>
        <div class="stat-num"><?= $totalInquiries ?></div>
        <div class="stat-label">Total Inquiries</div>
        <?php if ($unreadInquiries > 0): ?>
        <span class="badge-unread"><?= $unreadInquiries ?> unread</span>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card d-flex align-items-center gap-3">
      <div class="stat-icon blue"><i class="fas fa-file-alt"></i></div>
      <div>
        <div class="stat-num"><?= $totalQuotes ?></div>
        <div class="stat-label">Quote Requests</div>
        <?php if ($unreadQuotes > 0): ?>
        <span class="badge-unread"><?= $unreadQuotes ?> unread</span>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card d-flex align-items-center gap-3">
      <div class="stat-icon purple"><i class="fas fa-boxes-stacked"></i></div>
      <div>
        <div class="stat-num"><?= $totalCats ?></div>
        <div class="stat-label">Product Categories</div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card d-flex align-items-center gap-3">
      <div class="stat-icon orange"><i class="fas fa-images"></i></div>
      <div>
        <div class="stat-num"><?= $totalBanners ?></div>
        <div class="stat-label">Active Banners</div>
      </div>
    </div>
  </div>
</div>

<!-- Recent Inquiries & Quotes -->
<div class="row g-4">
  <div class="col-lg-6">
    <div class="admin-card">
      <div class="admin-card-header">
        <h6 class="mb-0 fw-bold">Recent Contact Inquiries</h6>
        <a href="<?= SITE_URL ?>/admin/inquiries.php" class="btn btn-sm btn-light">View All</a>
      </div>
      <div class="admin-card-body p-0">
        <table class="admin-table w-100">
          <thead><tr><th>Name</th><th>Email</th><th>Date</th><th>Status</th></tr></thead>
          <tbody>
            <?php if (empty($recentInquiries)): ?>
            <tr><td colspan="4" class="text-center text-muted py-4">No inquiries yet.</td></tr>
            <?php else: foreach ($recentInquiries as $inq): ?>
            <tr>
              <td><?= e($inq['name']) ?></td>
              <td class="text-muted small"><?= e($inq['email']) ?></td>
              <td class="text-muted small"><?= date('d M', strtotime($inq['created_at'])) ?></td>
              <td><?= $inq['is_read'] ? '<span class="badge-active">Read</span>' : '<span class="badge-unread">New</span>' ?></td>
            </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="admin-card">
      <div class="admin-card-header">
        <h6 class="mb-0 fw-bold">Recent Quote Requests</h6>
        <a href="<?= SITE_URL ?>/admin/quotes.php" class="btn btn-sm btn-light">View All</a>
      </div>
      <div class="admin-card-body p-0">
        <table class="admin-table w-100">
          <thead><tr><th>Name</th><th>Category</th><th>Date</th><th>Status</th></tr></thead>
          <tbody>
            <?php if (empty($recentQuotes)): ?>
            <tr><td colspan="4" class="text-center text-muted py-4">No quote requests yet.</td></tr>
            <?php else: foreach ($recentQuotes as $q): ?>
            <tr>
              <td><?= e($q['name']) ?></td>
              <td class="text-muted small"><?= e($q['product_category']) ?></td>
              <td class="text-muted small"><?= date('d M', strtotime($q['created_at'])) ?></td>
              <td><?= $q['is_read'] ? '<span class="badge-active">Read</span>' : '<span class="badge-unread">New</span>' ?></td>
            </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
