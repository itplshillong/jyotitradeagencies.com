<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/security.php';
require_once __DIR__ . '/includes/auth.php';

if (adminLoggedIn()) {
    redirect(SITE_URL . '/admin/dashboard.php');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    // ── Brute-force protection (session-based) ──────────────────────
    $_SESSION['login_attempts']   = $_SESSION['login_attempts']   ?? 0;
    $_SESSION['login_lockout_ts'] = $_SESSION['login_lockout_ts'] ?? 0;

    if (time() < $_SESSION['login_lockout_ts']) {
        $wait  = (int) ceil(($_SESSION['login_lockout_ts'] - time()) / 60);
        $error = 'Too many failed login attempts. Please wait ' . $wait . ' minute(s) before trying again.';
    } else {
        $username = sanitize($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $error = 'Please enter your username and password.';
        } else {
            $stmt = getDB()->prepare('SELECT * FROM admin_users WHERE username = ? AND is_active = 1 LIMIT 1');
            $stmt->execute([$username]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['password'])) {
                // Success — reset counters, regenerate session
                $_SESSION['login_attempts']   = 0;
                $_SESSION['login_lockout_ts'] = 0;
                session_regenerate_id(true);
                $_SESSION['admin_id']   = $admin['id'];
                $_SESSION['admin_user'] = ['full_name' => $admin['full_name'], 'email' => $admin['email']];
                // Update last login
                getDB()->prepare('UPDATE admin_users SET last_login = NOW() WHERE id = ?')->execute([$admin['id']]);
                redirect(SITE_URL . '/admin/dashboard.php');
            } else {
                $_SESSION['login_attempts']++;
                if ($_SESSION['login_attempts'] >= 5) {
                    $_SESSION['login_lockout_ts'] = time() + 300; // 5-minute lockout
                    $_SESSION['login_attempts']   = 0;
                    $error = 'Too many failed login attempts. Account locked for 5 minutes.';
                } else {
                    $remaining = 5 - $_SESSION['login_attempts'];
                    $error = 'Invalid username or password. ' . $remaining . ' attempt(s) remaining before lockout.';
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Login — Jyoti Trade Agencies</title>
<meta name="robots" content="noindex,nofollow">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
<link href="<?= SITE_URL ?>/admin/assets/css/admin.css" rel="stylesheet">
</head>
<body>
<div class="admin-login-wrapper">
  <div class="admin-login-card">
    <div class="text-center mb-4">
      <div style="width:64px;height:64px;background:linear-gradient(135deg,#10B981,#0EA5E9);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-size:1.8rem;color:#fff;">
        <i class="fas fa-paw"></i>
      </div>
      <h4 style="font-family:'Poppins',sans-serif;font-weight:700;color:#0F172A">Admin Panel</h4>
      <p class="text-muted small">Jyoti Trade Agencies — Secure Login</p>
    </div>

    <?php if ($error): ?>
    <div class="alert alert-danger d-flex align-items-center gap-2 mb-3" role="alert">
      <i class="fas fa-exclamation-circle"></i><?= e($error) ?>
    </div>
    <?php endif; ?>

    <form method="post" novalidate>
      <?= csrf_field() ?>
      <div class="mb-3">
        <label class="form-label fw-600" style="font-weight:600">Username</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-user text-muted"></i></span>
          <input type="text" name="username" class="form-control" placeholder="Enter username" required autofocus maxlength="100"
            value="<?= e(sanitize($_POST['username'] ?? '')) ?>">
        </div>
      </div>
      <div class="mb-4">
        <label class="form-label fw-600" style="font-weight:600">Password</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
          <input type="password" name="password" class="form-control" placeholder="Enter password" required maxlength="255">
        </div>
      </div>
      <button type="submit" class="btn-primary-admin w-100" style="padding:.75rem">
        <i class="fas fa-right-to-bracket me-2"></i>Sign In
      </button>
    </form>
  </div>
</div>
</body>
</html>
