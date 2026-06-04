<?php
require_once __DIR__ . '/includes/init.php';
$metaTitle = 'Get A Quote - ' . getSetting('company_name');
$metaDesc  = 'Request a quote for veterinary medicines, surgical instruments, chemicals, laboratory products and healthcare solutions from Jyoti Trade Agencies.';

$preselectedCategory = isset($_GET['category']) ? htmlspecialchars(strip_tags($_GET['category']), ENT_QUOTES, 'UTF-8') : '';
$categories = getDB()->query('SELECT name FROM product_categories WHERE is_active=1 ORDER BY sort_order ASC')->fetchAll(PDO::FETCH_COLUMN);
$defaultCats = ['Veterinary Medicines','Surgical Instruments','Chemicals','Laboratories','Health Care Products'];
$catList = !empty($categories) ? $categories : $defaultCats;
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<section class="page-hero">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-3">
        <li class="breadcrumb-item"><a href="<?= SITE_URL ?>/">Home</a></li>
        <li class="breadcrumb-item active">Get A Quote</li>
      </ol>
    </nav>
    <h1 class="page-hero-title" data-aos="fade-up">Get A Quote</h1>
    <p class="page-hero-sub" data-aos="fade-up" data-aos-delay="100">Share your veterinary product requirements and we'll provide a competitive quote promptly.</p>
  </div>
</section>

<section style="padding:5rem 0;background:#F8FAFC;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8" data-aos="fade-up">

        <!-- Why request a quote info strip -->
        <div class="row g-3 mb-5">
          <?php
          $qBenefits = [
            ['fas fa-bolt','Fast Response','We respond to all quote requests within 24 business hours.'],
            ['fas fa-tag','Competitive Pricing','Get the best market pricing for bulk and regular orders.'],
            ['fas fa-shield-halved','Quality Assured','All products meet international quality standards.'],
          ];
          foreach ($qBenefits as $b): ?>
          <div class="col-md-4">
            <div style="background:#fff;border-radius:10px;padding:1.25rem;text-align:center;box-shadow:0 2px 12px rgba(15,23,42,.06)">
              <i class="<?= $b[0] ?> fa-lg mb-2" style="color:var(--secondary)"></i>
              <div style="font-weight:700;font-size:.9rem;margin-bottom:.25rem"><?= $b[1] ?></div>
              <p style="font-size:.8rem;color:#64748B;margin:0"><?= $b[2] ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="quote-form-card">
          <h4 class="mb-1">Quote Request Form</h4>
          <p class="text-muted small mb-4">All fields marked with <span class="text-danger">*</span> are required.</p>

          <div id="quoteMsg"></div>

          <form id="quoteForm" novalidate>
            <?= csrf_field() ?>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="Your full name" required maxlength="255">
              </div>
              <div class="col-md-6">
                <label class="form-label">Company Name</label>
                <input type="text" name="company_name" class="form-control" placeholder="Your company / organization" maxlength="255">
              </div>
              <div class="col-md-6">
                <label class="form-label">State/Country <span class="text-danger">*</span></label>
                <input type="text" name="country" class="form-control" placeholder="Your country" required maxlength="100">
              </div>
              <div class="col-md-6">
                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" placeholder="you@company.com" required maxlength="255">
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                <input type="tel" name="phone" class="form-control" placeholder="+91 XXXXX XXXXX" required maxlength="50">
              </div>
              <div class="col-md-6">
                <label class="form-label">Product Category <span class="text-danger">*</span></label>
                <select name="product_category" class="form-select" required>
                  <option value="">-- Select Category --</option>
                  <?php foreach ($catList as $cat): ?>
                  <option value="<?= e($cat) ?>" <?= ($preselectedCategory === $cat) ? 'selected' : '' ?>><?= e($cat) ?></option>
                  <?php endforeach; ?>
                  <option value="Multiple Categories">Multiple Categories</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Quantity / Volume</label>
                <input type="text" name="quantity" class="form-control" placeholder="e.g. 500 units / 100 kg" maxlength="255">
              </div>
              <div class="col-12">
                <label class="form-label">Requirement Details <span class="text-danger">*</span></label>
                <textarea name="requirement_details" class="form-control" rows="6" required maxlength="5000"
                  placeholder="Please describe your specific product requirements, specifications, target market, regularity of order, etc."><?= $preselectedCategory ? 'I am interested in: ' . e($preselectedCategory) . "\n\n" : '' ?></textarea>
              </div>
              <div class="col-12">
                <button type="submit" class="btn-submit">
                  <i class="fas fa-paper-plane me-2"></i>Submit Quote Request
                </button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
