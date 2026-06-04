<?php
require_once __DIR__ . '/includes/init.php';
$metaTitle = 'Products - ' . getSetting('company_name');
$metaDesc  = 'Explore our comprehensive range of veterinary medicines, equipments, instruments, diagnostics/chemicals, laboratory products and healthcare solutions.';

$categories = getDB()->query('SELECT * FROM product_categories WHERE is_active=1 ORDER BY sort_order ASC')->fetchAll();
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<!-- Page Hero -->
<section class="page-hero">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-3">
        <li class="breadcrumb-item"><a href="<?= SITE_URL ?>/">Home</a></li>
        <li class="breadcrumb-item active">Products</li>
      </ol>
    </nav>
    <h1 class="page-hero-title" data-aos="fade-up">Our Products</h1>
    <p class="page-hero-sub" data-aos="fade-up" data-aos-delay="100">Complete Veterinary Healthcare Product Portfolio</p>
  </div>
</section>

<!-- Product Category Nav -->
<div style="background:#fff;border-bottom:1px solid #E2E8F0;position:sticky;top:72px;z-index:90;">
  <div class="container">
    <div class="d-flex gap-2 flex-wrap py-3">
      <?php
      $defaultCats = [
        ['veterinary-medicines','Veterinary Medicines','fas fa-pills'],
        ['Equipments & instruments','Equipments/Instruments','fas fa-scalpel'],
        ['chemicals','Chemicals','fas fa-flask'],
        ['laboratories','Laboratories','fas fa-microscope'],
        ['health-care-products','Health Care Products','fas fa-heart-pulse'],
      ];
      $displayCats = !empty($categories) ? array_map(fn($c) => [$c['slug'],$c['name'],'fas fa-box'], $categories) : $defaultCats;
      foreach ($displayCats as $c): ?>
      <a href="#<?= e($c[0]) ?>" class="product-nav-btn">
        <i class="<?= $c[2] ?> me-1"></i><?= e($c[1]) ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<style>
.product-nav-btn{background:#F8FAFC;color:#475569;border:1px solid #E2E8F0;padding:.4rem 1rem;border-radius:6px;font-size:.82rem;font-weight:600;transition:all .25s}
.product-nav-btn:hover{background:var(--secondary);color:#fff;border-color:var(--secondary)}
</style>

<!-- Products -->
<section style="padding:5rem 0;">
  <div class="container">

    <?php if (!empty($categories)):
      foreach ($categories as $i => $cat):
    ?>
    <div class="row g-5 align-items-center mb-6 <?= ($i % 2 !== 0) ? 'flex-row-reverse' : '' ?>"
         id="<?= e($cat['slug']) ?>"
         style="margin-bottom:5rem;padding-bottom:4rem;<?= ($i < count($categories)-1) ? 'border-bottom:1px solid #E2E8F0' : '' ?>"
         data-aos="fade-up">
      <div class="col-lg-5">
        <div style="border-radius:16px;overflow:hidden;box-shadow:0 12px 40px rgba(15,23,42,.1)">
          <?php if ($cat['image_path']): ?>
            <img src="<?= SITE_URL ?>/admin/uploads/products/<?= e($cat['image_path']) ?>" alt="<?= e($cat['name']) ?>" style="width:100%;height:360px;object-fit:cover" loading="lazy">
          <?php else: ?>
            <img src="<?= SITE_URL ?>/assets/images/products/default-<?= $cat['id'] ?>.svg" alt="<?= e($cat['name']) ?>" style="width:100%;height:360px;object-fit:cover" loading="lazy">
          <?php endif; ?>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="section-badge"><?= e($cat['name']) ?></div>
        <h2 class="section-title mt-2"><?= e($cat['name']) ?></h2>
        <div class="section-divider left mb-4"></div>
        <p class="text-muted lh-lg"><?= e($cat['description']) ?></p>
        <div class="d-flex flex-wrap gap-3 mt-4">
          <?php if ($cat['pdf_path']): ?>
          <a href="<?= SITE_URL ?>/admin/uploads/pdfs/<?= e($cat['pdf_path']) ?>" class="btn-primary-hero" style="font-size:.9rem;padding:.7rem 1.5rem" target="_blank" rel="noopener">
            <i class="fas fa-file-pdf me-2"></i>Download Catalogue
          </a>
          <?php endif; ?>
          <a href="<?= SITE_URL ?>/quote.php?category=<?= urlencode($cat['name']) ?>" class="btn-outline-hero" style="font-size:.9rem;padding:.7rem 1.5rem;border-color:var(--secondary);color:var(--secondary)">
            <i class="fas fa-envelope me-2"></i>Send Enquiry
          </a>
        </div>
      </div>
    </div>

    <?php endforeach;
    else:
      // Fallback static content
      $staticProds = [
        ['veterinary-medicines','Veterinary Medicines','fas fa-pills','Our veterinary medicines portfolio covers a comprehensive range of antibiotics, antiparasitics, antifungals, hormones, vitamins, minerals, vaccines and specialty pharmaceutical formulations. All products are sourced from certified manufacturers compliant with international veterinary pharmaceutical standards. Available for cattle, poultry, swine, equine, small animals and companion pets.'],
        ['equipments-instruments','Equipments/Instruments','fas fa-scalpel','We supply a complete range of precision-engineered veterinary  instruments including forceps, scalpels, scissors, retractors, needle holders, suture materials, autoclave equipment, and complete surgical kits. Our instruments meet veterinary professional requirements for clinics, hospitals and research institutions.'],
        ['chemicals','Chemicals','fas fa-flask','Our veterinary chemicals range includes laboratory-grade disinfectants, antiseptics, diagnostic reagents, staining solutions, buffered solutions and specialty chemical compounds. All chemicals are quality-tested and comply with relevant safety standards for professional veterinary diagnostic and treatment use.'],
        ['laboratories','Laboratories','fas fa-microscope','We offer advanced veterinary laboratory products including rapid diagnostic test kits, ELISA kits, PCR reagents, culture media, haematology analyzers, biochemistry analyzers and complete laboratory setup solutions for veterinary hospitals and research laboratories.'],
        ['health-care-products','Health Care Products','fas fa-heart-pulse','Comprehensive animal healthcare solutions including nutritional supplements, growth promoters, electrolytes, probiotics, wound care products, ectoparasiticides, grooming products and preventive healthcare essentials for all animal species.'],
      ];
      foreach ($staticProds as $i => $sp): ?>
    <div class="row g-5 align-items-center <?= ($i % 2 !== 0) ? 'flex-row-reverse' : '' ?>"
         id="<?= $sp[0] ?>"
         style="margin-bottom:5rem;padding-bottom:4rem;<?= ($i < count($staticProds)-1) ? 'border-bottom:1px solid #E2E8F0' : '' ?>"
         data-aos="fade-up">
      <div class="col-lg-5">
        <div style="border-radius:16px;overflow:hidden;box-shadow:0 12px 40px rgba(15,23,42,.1)">
          <img src="<?= SITE_URL ?>/assets/images/products/default-<?= ($i+1) ?>.svg" alt="<?= e($sp[1]) ?>" style="width:100%;height:360px;object-fit:cover" loading="lazy">
        </div>
      </div>
      <div class="col-lg-7">
        <div class="section-badge"><?= $sp[1] ?></div>
        <h2 class="section-title mt-2"><?= $sp[1] ?></h2>
        <div class="section-divider left mb-4"></div>
        <p class="text-muted lh-lg"><?= $sp[3] ?></p>
        <div class="d-flex flex-wrap gap-3 mt-4">
          <a href="<?= SITE_URL ?>/quote.php?category=<?= urlencode($sp[1]) ?>" class="btn-primary-hero" style="font-size:.9rem;padding:.7rem 1.5rem">
            <i class="fas fa-envelope me-2"></i>Send Enquiry
          </a>
        </div>
      </div>
    </div>
    <?php endforeach; endif; ?>

  </div>
</section>

<!-- CTA -->
<section class="cta-section">
  <div class="container text-center" data-aos="fade-up">
    <h2 class="cta-title">Need Custom Sourcing?</h2>
    <p class="cta-text mx-auto" style="max-width:500px">We handle custom orders, bulk requirements and specialty sourcing. Share your requirement and we'll respond promptly.</p>
    <a href="<?= SITE_URL ?>/quote.php" class="btn-primary-hero"><i class="fas fa-file-alt me-2"></i>Get A Quote</a>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
