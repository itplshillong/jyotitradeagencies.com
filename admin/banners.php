<?php
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();
$adminPageTitle = 'Banner Management';
$db = getDB();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id         = (int)($_POST['id'] ?? 0);
        $title      = sanitize($_POST['title'] ?? '');
        $subtitle   = sanitize($_POST['subtitle'] ?? '');
        $btn1_text  = sanitize($_POST['btn1_text'] ?? '');
        $btn1_link  = sanitize($_POST['btn1_link'] ?? '');
        $btn2_text  = sanitize($_POST['btn2_text'] ?? '');
        $btn2_link  = sanitize($_POST['btn2_link'] ?? '');
        $sort_order = (int)($_POST['sort_order'] ?? 0);
        $is_active  = isset($_POST['is_active']) ? 1 : 0;

        $imagePath = $_POST['existing_image'] ?? '';
        if (!empty($_FILES['image']['name'])) {
            $file = $_FILES['image'];
            $allowed = ['image/jpeg','image/png','image/webp','image/gif'];
            if (!in_array(mime_content_type($file['tmp_name']), $allowed, true) || $file['size'] > 8*1024*1024) {
                $msg = '<div class="alert alert-danger">Invalid image. JPG/PNG/WEBP, max 8MB.</div>'; goto done;
            }
            // Derive extension from verified MIME type — never trust user-supplied filename
            $mimeToExt = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/gif' => 'gif'];
            $ext   = $mimeToExt[mime_content_type($file['tmp_name'])] ?? 'bin';
            $fname = 'banner_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            move_uploaded_file($file['tmp_name'], SITE_ROOT . '/admin/uploads/banners/' . $fname);
            $imagePath = $fname;
        }

        if ($title === '') { $msg = '<div class="alert alert-danger">Title is required.</div>'; goto done; }

        if ($id > 0) {
            $db->prepare('UPDATE banners SET title=?,subtitle=?,image_path=?,btn1_text=?,btn1_link=?,btn2_text=?,btn2_link=?,sort_order=?,is_active=? WHERE id=?')
               ->execute([$title,$subtitle,$imagePath,$btn1_text,$btn1_link,$btn2_text,$btn2_link,$sort_order,$is_active,$id]);
            $msg = '<div class="alert alert-success auto-dismiss">Banner updated.</div>';
        } else {
            $db->prepare('INSERT INTO banners (title,subtitle,image_path,btn1_text,btn1_link,btn2_text,btn2_link,sort_order,is_active) VALUES (?,?,?,?,?,?,?,?,?)')
               ->execute([$title,$subtitle,$imagePath,$btn1_text,$btn1_link,$btn2_text,$btn2_link,$sort_order,$is_active]);
            $msg = '<div class="alert alert-success auto-dismiss">Banner added.</div>';
        }
    }
    if ($action === 'delete') {
        $db->prepare('DELETE FROM banners WHERE id=?')->execute([(int)$_POST['id']]);
        $msg = '<div class="alert alert-success auto-dismiss">Banner deleted.</div>';
    }
}
done:
$edit = null;
if (isset($_GET['edit'])) {
    $s = $db->prepare('SELECT * FROM banners WHERE id=?');
    $s->execute([(int)$_GET['edit']]);
    $edit = $s->fetch();
}
$banners = $db->query('SELECT * FROM banners ORDER BY sort_order ASC')->fetchAll();
include __DIR__ . '/includes/header.php';
?>

<?= $msg ?>

<div class="row g-4">
  <div class="col-lg-5">
    <div class="admin-card">
      <div class="admin-card-header">
        <h6 class="mb-0 fw-bold"><?= $edit ? 'Edit Banner' : 'Add Banner' ?></h6>
        <?php if ($edit): ?><a href="banners.php" class="btn btn-sm btn-light">+ Add New</a><?php endif; ?>
      </div>
      <div class="admin-card-body">
        <form method="post" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save">
          <input type="hidden" name="id" value="<?= $edit ? $edit['id'] : 0 ?>">
          <input type="hidden" name="existing_image" value="<?= e($edit['image_path'] ?? '') ?>">
          <div class="mb-3">
            <label class="form-label">Title *</label>
            <input type="text" name="title" class="form-control" required value="<?= e($edit['title'] ?? '') ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Subtitle</label>
            <textarea name="subtitle" class="form-control" rows="2"><?= e($edit['subtitle'] ?? '') ?></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Banner Image</label>
            <?php if (!empty($edit['image_path'])): ?>
            <div class="mb-2"><img src="<?= SITE_URL ?>/admin/uploads/banners/<?= e($edit['image_path']) ?>" style="height:60px;border-radius:4px" id="bImgPrev"></div>
            <?php else: ?><img id="bImgPrev" src="" style="height:60px;border-radius:4px;display:none" class="mb-2"><?php endif; ?>
            <input type="file" name="image" class="form-control" accept="image/*" data-preview="#bImgPrev">
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6"><label class="form-label">Button 1 Text</label><input type="text" name="btn1_text" class="form-control" value="<?= e($edit['btn1_text'] ?? '') ?>"></div>
            <div class="col-6"><label class="form-label">Button 1 Link</label><input type="text" name="btn1_link" class="form-control" value="<?= e($edit['btn1_link'] ?? '') ?>"></div>
            <div class="col-6"><label class="form-label">Button 2 Text</label><input type="text" name="btn2_text" class="form-control" value="<?= e($edit['btn2_text'] ?? '') ?>"></div>
            <div class="col-6"><label class="form-label">Button 2 Link</label><input type="text" name="btn2_link" class="form-control" value="<?= e($edit['btn2_link'] ?? '') ?>"></div>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="<?= $edit['sort_order'] ?? 0 ?>" min="0"></div>
            <div class="col-6"><label class="form-label">Status</label><div class="form-check mt-2"><input class="form-check-input" type="checkbox" name="is_active" id="bActive" <?= (!$edit || $edit['is_active']) ? 'checked' : '' ?>><label class="form-check-label" for="bActive">Active</label></div></div>
          </div>
          <button type="submit" class="btn-primary-admin w-100"><i class="fas fa-save me-2"></i><?= $edit ? 'Update' : 'Add Banner' ?></button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-7">
    <div class="admin-card">
      <div class="admin-card-header"><h6 class="mb-0 fw-bold">All Banners</h6></div>
      <div class="admin-card-body p-0">
        <table class="admin-table w-100">
          <thead><tr><th>Image</th><th>Title</th><th>Sort</th><th>Status</th><th>Actions</th></tr></thead>
          <tbody>
            <?php if (empty($banners)): ?>
            <tr><td colspan="5" class="text-center text-muted py-4">No banners yet.</td></tr>
            <?php else: foreach ($banners as $b): ?>
            <tr>
              <td><?php if ($b['image_path']): ?><img src="<?= SITE_URL ?>/admin/uploads/banners/<?= e($b['image_path']) ?>" style="height:44px;border-radius:4px"><?php else: ?><span class="text-muted small">No image</span><?php endif; ?></td>
              <td><strong><?= e($b['title']) ?></strong></td>
              <td><?= $b['sort_order'] ?></td>
              <td><?= $b['is_active'] ? '<span class="badge-active">Active</span>' : '<span class="badge-inactive">Inactive</span>' ?></td>
              <td>
                <a href="?edit=<?= $b['id'] ?>" class="btn-edit-admin me-1">Edit</a>
                <form method="post" class="d-inline"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $b['id'] ?>"><button type="submit" class="btn-danger-admin btn-delete-confirm">Del</button></form>
              </td>
            </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
