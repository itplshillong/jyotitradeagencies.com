<?php
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();
$adminPageTitle = 'Settings';
$db = getDB();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $keys = ['company_name','phone','email','address','map_embed','whatsapp_number','smtp_host','smtp_port','smtp_username','smtp_sender_name','smtp_recipient'];
    foreach ($keys as $key) {
        $val = sanitize($_POST[$key] ?? '');
        $db->prepare('UPDATE settings SET setting_val=? WHERE setting_key=?')->execute([$val, $key]);
    }
    // SMTP password only update if provided — do NOT run through sanitize/strip_tags as
    // passwords may legitimately contain <, >, & and other characters strip_tags would remove
    if (!empty($_POST['smtp_password'])) {
        $db->prepare('UPDATE settings SET setting_val=? WHERE setting_key=?')->execute([$_POST['smtp_password'], 'smtp_password']);
    }
    $msg = '<div class="alert alert-success auto-dismiss">Settings saved successfully.</div>';
}

$all = $db->query('SELECT setting_key, setting_val FROM settings')->fetchAll();
$s = [];
foreach ($all as $r) $s[$r['setting_key']] = $r['setting_val'];

include __DIR__ . '/includes/header.php';
?>

<?= $msg ?>

<form method="post">
  <?= csrf_field() ?>
  <div class="row g-4">

    <!-- Company Info -->
    <div class="col-lg-6">
      <div class="admin-card h-100">
        <div class="admin-card-header"><h6 class="mb-0 fw-bold">Company Information</h6></div>
        <div class="admin-card-body">
          <div class="mb-3"><label class="form-label">Company Name</label><input type="text" name="company_name" class="form-control" value="<?= e($s['company_name'] ?? '') ?>"></div>
          <div class="mb-3"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="<?= e($s['phone'] ?? '') ?>"></div>
          <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="<?= e($s['email'] ?? '') ?>"></div>
          <div class="mb-3"><label class="form-label">Address</label><textarea name="address" class="form-control" rows="3"><?= e($s['address'] ?? '') ?></textarea></div>
          <div class="mb-3">
            <label class="form-label">WhatsApp Number <small class="text-muted">(with country code)</small></label>
            <div class="input-group">
              <span class="input-group-text"><i class="fab fa-whatsapp text-success"></i></span>
              <input type="text" name="whatsapp_number" class="form-control" value="<?= e($s['whatsapp_number'] ?? '') ?>" placeholder="919876543210" maxlength="20">
            </div>
            <small class="text-muted">Enter digits only with country code. Example: <strong>919876543210</strong> for India (+91). Leave blank to hide the WhatsApp button.</small>
          </div>
          <div class="mb-3"><label class="form-label">Google Map Embed Code</label><textarea name="map_embed" class="form-control" rows="4" placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'><?= e($s['map_embed'] ?? '') ?></textarea></div>
        </div>
      </div>
    </div>

    <!-- SMTP -->
    <div class="col-lg-6">
      <div class="admin-card h-100">
        <div class="admin-card-header"><h6 class="mb-0 fw-bold">Gmail SMTP Configuration</h6></div>
        <div class="admin-card-body">
          <div class="alert alert-info d-flex gap-2" style="font-size:.82rem"><i class="fas fa-info-circle mt-1"></i><span>Use Gmail App Password (not your Gmail login password). Enable 2FA on your Gmail account first.</span></div>
          <div class="mb-3"><label class="form-label">SMTP Host</label><input type="text" name="smtp_host" class="form-control" value="<?= e($s['smtp_host'] ?? 'smtp.gmail.com') ?>"></div>
          <div class="mb-3"><label class="form-label">SMTP Port</label><input type="number" name="smtp_port" class="form-control" value="<?= e($s['smtp_port'] ?? '587') ?>"></div>
          <div class="mb-3"><label class="form-label">SMTP Username (Gmail)</label><input type="email" name="smtp_username" class="form-control" value="<?= e($s['smtp_username'] ?? '') ?>" placeholder="youremail@gmail.com"></div>
          <div class="mb-3"><label class="form-label">SMTP Password / App Password</label><input type="password" name="smtp_password" class="form-control" placeholder="Leave blank to keep current password" autocomplete="new-password"></div>
          <div class="mb-3"><label class="form-label">Sender Name</label><input type="text" name="smtp_sender_name" class="form-control" value="<?= e($s['smtp_sender_name'] ?? '') ?>"></div>
          <div class="mb-3"><label class="form-label">Recipient Email (Receive inquiries at)</label><input type="email" name="smtp_recipient" class="form-control" value="<?= e($s['smtp_recipient'] ?? '') ?>" placeholder="info@jyotitradeagencies.com"></div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <button type="submit" class="btn-primary-admin px-5"><i class="fas fa-save me-2"></i>Save All Settings</button>
    </div>
  </div>
</form>

<?php include __DIR__ . '/includes/footer.php'; ?>
