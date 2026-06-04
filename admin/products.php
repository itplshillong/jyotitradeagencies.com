<?php
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();

$adminPageTitle = 'Product Categories';
$db = getDB();
$msg = '';

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $action = $_POST['action'] ?? '';

    // Allowed MIME types for images
    $allowedImageMimes = ['image/jpeg','image/png','image/webp','image/gif'];
    $allowedPdfMimes   = ['application/pdf'];

    if ($action === 'save') {
        $id          = (int)($_POST['id'] ?? 0);
        $name        = sanitize($_POST['name'] ?? '');
        $slug        = sanitize($_POST['slug'] ?? '');
        $description = sanitize($_POST['description'] ?? '');
        $sort_order  = (int)($_POST['sort_order'] ?? 0);
        $is_active   = isset($_POST['is_active']) ? 1 : 0;

        if ($name === '') { $msg = '<div class="alert alert-danger">Name is required.</div>'; goto done; }
        if ($slug === '') $slug = strtolower(preg_replace('/[^a-z0-9]+/i','-',$name));

        // Handle image upload
        $imagePath = $_POST['existing_image'] ?? '';
        if (!empty($_FILES['image']['name'])) {
            $file = $_FILES['image'];
            if (!in_array(mime_content_type($file['tmp_name']), $allowedImageMimes, true)) {
                $msg = '<div class="alert alert-danger">Invalid image type. JPG, PNG, WEBP or GIF allowed.</div>'; goto done;
            }
            if ($file['size'] > 5 * 1024 * 1024) {
                $msg = '<div class="alert alert-danger">Image must be under 5MB.</div>'; goto done;
            }
            // Derive extension from verified MIME type — never trust user-supplied filename
            $mimeToExt = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/gif' => 'gif'];
            $ext = $mimeToExt[mime_content_type($file['tmp_name'])] ?? 'bin';
            $fname = 'prod_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            move_uploaded_file($file['tmp_name'], SITE_ROOT . '/admin/uploads/products/' . $fname);
            $imagePath = $fname;
        }

        // Handle PDF upload
        $pdfPath = $_POST['existing_pdf'] ?? '';
        if (!empty($_FILES['pdf']['name'])) {
            $file = $_FILES['pdf'];
            if (!in_array(mime_content_type($file['tmp_name']), $allowedPdfMimes, true)) {
                $msg = '<div class="alert alert-danger">Only PDF files are allowed.</div>'; goto done;
            }
            if ($file['size'] > 20 * 1024 * 1024) {
                $msg = '<div class="alert alert-danger">PDF must be under 20MB.</div>'; goto done;
            }
            $fname = 'cat_' . time() . '_' . bin2hex(random_bytes(4)) . '.pdf';
            move_uploaded_file($file['tmp_name'], SITE_ROOT . '/admin/uploads/pdfs/' . $fname);
            $pdfPath = $fname;
        }

        if ($id > 0) {
            $db->prepare('UPDATE product_categories SET name=?,slug=?,description=?,image_path=?,pdf_path=?,sort_order=?,is_active=? WHERE id=?')
               ->execute([$name,$slug,$description,$imagePath,$pdfPath,$sort_order,$is_active,$id]);
            $msg = '<div class="alert alert-success auto-dismiss">Category updated successfully.</div>';
        } else {
            $db->prepare('INSERT INTO product_categories (name,slug,description,image_path,pdf_path,sort_order,is_active) VALUES (?,?,?,?,?,?,?)')
               ->execute([$name,$slug,$description,$imagePath,$pdfPath,$sort_order,$is_active]);
            $msg = '<div class="alert alert-success auto-dismiss">Category added successfully.</div>';
        }
    }

    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        $db->prepare('DELETE FROM product_categories WHERE id=?')->execute([$id]);
        $msg = '<div class="alert alert-success auto-dismiss">Category deleted.</div>';
    }
}
done:

$edit = null;
if (isset($_GET['edit'])) {
    $edit = $db->prepare('SELECT * FROM product_categories WHERE id=?');
    $edit->execute([(int)$_GET['edit']]);
    $edit = $edit->fetch();
}

$categories = $db->query('SELECT * FROM product_categories ORDER BY sort_order ASC')->fetchAll();
include __DIR__ . '/includes/header.php';
?>

<?= $msg ?>

<div class="row g-4">
  <!-- Form -->
  <div class="col-lg-5">
    <div class="admin-card">
      <div class="admin-card-header">
        <h6 class="mb-0 fw-bold"><?= $edit ? 'Edit Category' : 'Add New Category' ?></h6>
        <?php if ($edit): ?><a href="<?= SITE_URL ?>/admin/products.php" class="btn btn-sm btn-light">+ Add New</a><?php endif; ?>
      </div>
      <div class="admin-card-body">
        <form method="post" enctype="multipart/form-data" novalidate>
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="save">
          <input type="hidden" name="id" value="<?= $edit ? $edit['id'] : 0 ?>">
          <input type="hidden" name="existing_image" value="<?= e($edit['image_path'] ?? '') ?>">
          <input type="hidden" name="existing_pdf" value="<?= e($edit['pdf_path'] ?? '') ?>">

          <div class="mb-3">
            <label class="form-label">Category Name *</label>
            <input type="text" name="name" class="form-control" required value="<?= e($edit['name'] ?? '') ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Slug (URL-friendly)</label>
            <input type="text" name="slug" class="form-control" value="<?= e($edit['slug'] ?? '') ?>" placeholder="auto-generated if empty">
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"><?= e($edit['description'] ?? '') ?></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Category Image</label>
            <?php if (!empty($edit['image_path'])): ?>
            <div class="mb-2"><img src="<?= SITE_URL ?>/admin/uploads/products/<?= e($edit['image_path']) ?>" style="height:80px;border-radius:6px;object-fit:cover" id="imgPreview"></div>
            <?php else: ?>
            <img id="imgPreview" src="" style="height:80px;border-radius:6px;object-fit:cover;display:none" class="mb-2">
            <?php endif; ?>
            <input type="file" name="image" class="form-control" accept="image/*" data-preview="#imgPreview">
            <small class="text-muted">JPG/PNG/WEBP, max 5MB</small>
          </div>
          <div class="mb-3">
            <label class="form-label">PDF Catalogue</label>
            <?php if (!empty($edit['pdf_path'])): ?>
            <div class="mb-2"><a href="<?= SITE_URL ?>/admin/uploads/pdfs/<?= e($edit['pdf_path']) ?>" target="_blank" class="text-success small"><i class="fas fa-file-pdf me-1"></i>Current PDF</a></div>
            <?php endif; ?>
            <input type="file" name="pdf" class="form-control" accept=".pdf,application/pdf">
            <small class="text-muted">PDF only, max 20MB</small>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label">Sort Order</label>
              <input type="number" name="sort_order" class="form-control" value="<?= $edit['sort_order'] ?? 0 ?>" min="0">
            </div>
            <div class="col-6">
              <label class="form-label">Status</label>
              <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" <?= (!$edit || $edit['is_active']) ? 'checked' : '' ?>>
                <label class="form-check-label" for="isActive">Active</label>
              </div>
            </div>
          </div>
          <button type="submit" class="btn-primary-admin w-100">
            <i class="fas fa-save me-2"></i><?= $edit ? 'Update Category' : 'Add Category' ?>
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- List -->
  <div class="col-lg-7">
    <div class="admin-card">
      <div class="admin-card-header">
        <h6 class="mb-0 fw-bold">Product Categories (<?= count($categories) ?>)</h6>
      </div>
      <div class="admin-card-body p-0">
        <table class="admin-table w-100">
          <thead><tr><th>#</th><th>Name</th><th>PDF</th><th>Sort</th><th>Status</th><th>Actions</th></tr></thead>
          <tbody>
            <?php if (empty($categories)): ?>
            <tr><td colspan="6" class="text-center text-muted py-4">No categories found.</td></tr>
            <?php else: foreach ($categories as $cat): ?>
            <tr>
              <td><?= $cat['id'] ?></td>
              <td>
                <strong><?= e($cat['name']) ?></strong>
                <?php if ($cat['image_path']): ?>
                <br><img src="<?= SITE_URL ?>/admin/uploads/products/<?= e($cat['image_path']) ?>" style="height:36px;border-radius:4px;margin-top:4px">
                <?php endif; ?>
              </td>
              <td><?= $cat['pdf_path'] ? '<span class="badge-active"><i class="fas fa-check"></i></span>' : '<span class="badge-inactive">None</span>' ?></td>
              <td><?= $cat['sort_order'] ?></td>
              <td><?= $cat['is_active'] ? '<span class="badge-active">Active</span>' : '<span class="badge-inactive">Inactive</span>' ?></td>
              <td>
                <a href="?edit=<?= $cat['id'] ?>" class="btn-edit-admin me-1">Edit</a>
                <form method="post" class="d-inline">
                  <?= csrf_field() ?>
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= $cat['id'] ?>">
                  <button type="submit" class="btn-danger-admin btn-delete-confirm">Del</button>
                </form>
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
