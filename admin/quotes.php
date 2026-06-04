<?php
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();
$adminPageTitle = 'Quote Requests';
$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    csrf_verify();
    $db->prepare('DELETE FROM quote_requests WHERE id=?')->execute([(int)$_POST['id']]);
    header('Location: quotes.php'); exit;
}

$view = null;
if (isset($_GET['view'])) {
    $s = $db->prepare('SELECT * FROM quote_requests WHERE id=?');
    $s->execute([(int)$_GET['view']]);
    $view = $s->fetch();
    if ($view) $db->prepare('UPDATE quote_requests SET is_read=1 WHERE id=?')->execute([$view['id']]);
}

$quotes = $db->query('SELECT * FROM quote_requests ORDER BY created_at DESC')->fetchAll();
include __DIR__ . '/includes/header.php';
?>

<?php if ($view): ?>
<div class="mb-3"><a href="quotes.php" class="btn btn-sm btn-light"><i class="fas fa-arrow-left me-1"></i>Back</a></div>
<div class="admin-card" style="max-width:700px">
  <div class="admin-card-header"><h6 class="mb-0 fw-bold">Quote Request #<?= $view['id'] ?></h6><span class="text-muted small"><?= date('d M Y, H:i', strtotime($view['created_at'])) ?></span></div>
  <div class="admin-card-body">
    <table class="table table-borderless" style="font-size:.9rem">
      <tr><th width="180">Name</th><td><?= e($view['name']) ?></td></tr>
      <tr><th>Company</th><td><?= e($view['company_name'] ?: '—') ?></td></tr>
      <tr><th>Country</th><td><?= e($view['country'] ?: '—') ?></td></tr>
      <tr><th>Email</th><td><a href="mailto:<?= e($view['email']) ?>"><?= e($view['email']) ?></a></td></tr>
      <tr><th>Phone</th><td><?= e($view['phone'] ?: '—') ?></td></tr>
      <tr><th>Product Category</th><td><?= e($view['product_category'] ?: '—') ?></td></tr>
      <tr><th>Quantity</th><td><?= e($view['quantity'] ?: '—') ?></td></tr>
      <tr><th>Requirement Details</th><td><?= nl2br(e($view['requirement_details'])) ?></td></tr>
    </table>
    <div class="d-flex gap-2 mt-3">
      <a href="mailto:<?= e($view['email']) ?>" class="btn-primary-admin"><i class="fas fa-reply me-1"></i>Reply</a>
      <form method="post" class="d-inline"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $view['id'] ?>"><button type="submit" class="btn-danger-admin btn-delete-confirm">Delete</button></form>
    </div>
  </div>
</div>

<?php else: ?>
<div class="admin-card">
  <div class="admin-card-header"><h6 class="mb-0 fw-bold">Quote Requests (<?= count($quotes) ?>)</h6></div>
  <div class="admin-card-body p-0">
    <table class="admin-table w-100">
      <thead><tr><th>#</th><th>Name</th><th>Country</th><th>Category</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <?php if (empty($quotes)): ?>
        <tr><td colspan="7" class="text-center text-muted py-5">No quote requests yet.</td></tr>
        <?php else: foreach ($quotes as $q): ?>
        <tr style="<?= !$q['is_read'] ? 'font-weight:600;background:#FEFCE8' : '' ?>">
          <td><?= $q['id'] ?></td>
          <td><?= e($q['name']) ?></td>
          <td><?= e($q['country'] ?: '—') ?></td>
          <td><?= e($q['product_category'] ?: '—') ?></td>
          <td><?= date('d M Y', strtotime($q['created_at'])) ?></td>
          <td><?= $q['is_read'] ? '<span class="badge-active">Read</span>' : '<span class="badge-unread">New</span>' ?></td>
          <td>
            <a href="?view=<?= $q['id'] ?>" class="btn-edit-admin me-1">View</a>
            <form method="post" class="d-inline"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $q['id'] ?>"><button type="submit" class="btn-danger-admin btn-delete-confirm">Del</button></form>
          </td>
        </tr>
        <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
