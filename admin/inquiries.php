<?php
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();
$adminPageTitle = 'Contact Inquiries';
$db = getDB();

// Mark as read
if (isset($_GET['read'])) {
    $db->prepare('UPDATE inquiries SET is_read=1 WHERE id=?')->execute([(int)$_GET['read']]);
    header('Location: inquiries.php'); exit;
}

// Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    csrf_verify();
    $db->prepare('DELETE FROM inquiries WHERE id=?')->execute([(int)$_POST['id']]);
    header('Location: inquiries.php'); exit;
}

// View single
$view = null;
if (isset($_GET['view'])) {
    $s = $db->prepare('SELECT * FROM inquiries WHERE id=?');
    $s->execute([(int)$_GET['view']]);
    $view = $s->fetch();
    if ($view) $db->prepare('UPDATE inquiries SET is_read=1 WHERE id=?')->execute([$view['id']]);
}

$inquiries = $db->query('SELECT * FROM inquiries ORDER BY created_at DESC')->fetchAll();
include __DIR__ . '/includes/header.php';
?>

<?php if ($view): ?>
<!-- Detail View -->
<div class="mb-3"><a href="inquiries.php" class="btn btn-sm btn-light"><i class="fas fa-arrow-left me-1"></i>Back</a></div>
<div class="admin-card" style="max-width:700px">
  <div class="admin-card-header"><h6 class="mb-0 fw-bold">Inquiry #<?= $view['id'] ?></h6><span class="text-muted small"><?= date('d M Y, H:i', strtotime($view['created_at'])) ?></span></div>
  <div class="admin-card-body">
    <table class="table table-borderless" style="font-size:.9rem">
      <tr><th width="160">Name</th><td><?= e($view['name']) ?></td></tr>
      <tr><th>Company</th><td><?= e($view['company_name'] ?: '—') ?></td></tr>
      <tr><th>Email</th><td><a href="mailto:<?= e($view['email']) ?>"><?= e($view['email']) ?></a></td></tr>
      <tr><th>Phone</th><td><?= e($view['phone'] ?: '—') ?></td></tr>
      <tr><th>IP Address</th><td><?= e($view['ip_address'] ?: '—') ?></td></tr>
      <tr><th>Message</th><td><?= nl2br(e($view['message'])) ?></td></tr>
    </table>
    <div class="d-flex gap-2 mt-3">
      <a href="mailto:<?= e($view['email']) ?>" class="btn-primary-admin"><i class="fas fa-reply me-1"></i>Reply</a>
      <form method="post" class="d-inline"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $view['id'] ?>"><button type="submit" class="btn-danger-admin btn-delete-confirm">Delete</button></form>
    </div>
  </div>
</div>

<?php else: ?>
<div class="admin-card">
  <div class="admin-card-header">
    <h6 class="mb-0 fw-bold">Contact Inquiries (<?= count($inquiries) ?>)</h6>
  </div>
  <div class="admin-card-body p-0">
    <table class="admin-table w-100">
      <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Company</th><th>Phone</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <?php if (empty($inquiries)): ?>
        <tr><td colspan="8" class="text-center text-muted py-5">No inquiries received yet.</td></tr>
        <?php else: foreach ($inquiries as $inq): ?>
        <tr style="<?= !$inq['is_read'] ? 'font-weight:600;background:#FEFCE8' : '' ?>">
          <td><?= $inq['id'] ?></td>
          <td><?= e($inq['name']) ?></td>
          <td><?= e($inq['email']) ?></td>
          <td><?= e($inq['company_name'] ?: '—') ?></td>
          <td><?= e($inq['phone'] ?: '—') ?></td>
          <td><?= date('d M Y', strtotime($inq['created_at'])) ?></td>
          <td><?= $inq['is_read'] ? '<span class="badge-active">Read</span>' : '<span class="badge-unread">New</span>' ?></td>
          <td>
            <a href="?view=<?= $inq['id'] ?>" class="btn-edit-admin me-1">View</a>
            <form method="post" class="d-inline"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $inq['id'] ?>"><button type="submit" class="btn-danger-admin btn-delete-confirm">Del</button></form>
          </td>
        </tr>
        <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
