<?php
require_once __DIR__ . '/includes/init.php';

// Fetch active banners
$banners = getDB()->query('SELECT * FROM banners WHERE is_active=1 ORDER BY sort_order ASC')->fetchAll();

// Fetch product categories
$categories = getDB()->query('SELECT * FROM product_categories WHERE is_active=1 ORDER BY sort_order ASC')->fetchAll();
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<!-- ===== HERO ===== -->
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 hero-content" data-aos="fade-right">
        <div class="hero-badge">
          <i class="fas fa-star"></i>
          Trusted Since 1960
        </div>
        <h1 class="hero-title">
          One Stop Veterinary<br><span>Solutions</span>
        </h1>
        <p class="hero-subtitle">
          Providing Veterinary Medicines, Equipments, Instruments, Diagnostics/Chemicals, Laboratory Solutions and Healthcare Products for Animal Health and Wellness.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <a href="<?= SITE_URL ?>/products.php" class="btn-primary-hero">
            <i class="fas fa-th-large me-2"></i>Explore Products
          </a>
          <a href="<?= SITE_URL ?>/quote.php" class="btn-outline-hero">
            <i class="fas fa-file-alt me-2"></i>Request Quote
          </a>
        </div>
      </div>
      <div class="col-lg-6 hero-animals" data-aos="fade-left" data-aos-delay="150">
        <div class="animal-grid">
          <div class="animal-card"><div class="animal-icon">🐄</div><span>Bovine</span></div>
               <div class="animal-card"><div class="animal-icon">🐖</div><span>Swine</span></div>
                   <div class="animal-card"><div class="animal-icon">🐐</div><span>Small Ruminants</span></div>
                             <div class="animal-card"><div class="animal-icon">🐎</div><span>Equine</span></div>
          <div class="animal-card"><div class="animal-icon">🐕</div><span>Canine</span></div>
                    <div class="animal-card"><div class="animal-icon">🐔</div><span>Poultry</span></div>
          <div class="animal-card"><div class="animal-icon">🐇</div><span>Rabbits</span></div>

          <div class="animal-card"><div class="animal-icon">🐈</div><span>Cats</span></div>  
          <div class="animal-card"><div class="animal-icon">🐟</div><span>Aquatic</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== COUNTERS ===== -->
<section class="counters-section">
  <div class="container">
    <div class="row g-4">
      <div class="col-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
        <div class="counter-card">
          <div class="counter-icon"><i class="fas fa-calendar-check"></i></div>
          <div class="counter-num"><span data-target="66" data-suffix="+">66+</span></div>
          <div class="counter-label">Years Experience</div>
        </div>
      </div>
      <div class="col-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="counter-card">
          <div class="counter-icon"><i class="fas fa-capsules"></i></div>
          <div class="counter-num"><span data-target="500" data-suffix="+">500+</span></div>
          <div class="counter-label">Products</div>
        </div>
      </div>
      
      <div class="col-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
        <div class="counter-card">
          <div class="counter-icon"><i class="fas fa-users"></i></div>
          <div class="counter-num"><span data-target="1000" data-suffix="+">300+</span></div>
          <div class="counter-label"> Clients</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== LEGACY SECTION ===== -->
<section class="legacy-section">
  <div class="container">
    <div class="section-header text-center" data-aos="fade-up">
      <div class="section-badge">Our Heritage</div>
      <h2 class="section-title">66 Years of Veterinary Excellence</h2>
      <div class="section-divider mx-auto"></div>
      <p class="text-muted mt-3 mx-auto" style="max-width:600px">Since 1960, Jyoti Trade Agencies has built a legacy of trust, quality and innovation in animal healthcare — spanning generations, borders and species.</p>
    </div>

    <!-- Legacy Stats Banner -->
    <div class="legacy-banner" data-aos="fade-up" data-aos-delay="100">
      <div class="legacy-stat">
        <div class="legacy-stat-year">1960</div>
        <div class="legacy-stat-label">Founded</div>
      </div>
      <div class="legacy-stat-divider"><i class="fas fa-long-arrow-alt-right"></i></div>
      <div class="legacy-stat">
        <div class="legacy-stat-num">3<span>rd</span></div>
        <div class="legacy-stat-label">Generation Business</div>
      </div>
      <div class="legacy-stat-divider"><i class="fas fa-long-arrow-alt-right"></i></div>
      <div class="legacy-stat">
        <div class="legacy-stat-num">66<span>+</span></div>
        <div class="legacy-stat-label">Years of Trust</div>
      </div>
      
    </div>

    <!-- Timeline -->
    <div class="legacy-timeline">

      <div class="timeline-item" data-aos="fade-right" data-aos-delay="0">
        <div class="timeline-dot"><i class="fas fa-seedling"></i></div>
        <div class="timeline-card">
          <div class="timeline-year">1960</div>
          <h5 class="timeline-title">The Foundation</h5>
          <p class="timeline-desc">Jyoti Trade Agencies was established with a singular vision — to make quality veterinary healthcare accessible to farmers and practitioners across North-East India.</p>
        </div>
      </div>

      <div class="timeline-item timeline-right" data-aos="fade-left" data-aos-delay="80">
        <div class="timeline-dot"><i class="fas fa-chart-line"></i></div>
        <div class="timeline-card">
          <div class="timeline-year">1975</div>
          <h5 class="timeline-title">Regional Expansion</h5>
          <p class="timeline-desc">Expanded across multiple states, building a trusted network of veterinary suppliers, distributors and livestock farmers.</p>
        </div>
      </div>

      <div class="timeline-item" data-aos="fade-right" data-aos-delay="160">
        <div class="timeline-dot"><i class="fas fa-flask"></i></div>
        <div class="timeline-card">
          <div class="timeline-year">1990</div>
          <h5 class="timeline-title">Product Range Diversification</h5>
          <p class="timeline-desc">Broadened the portfolio to include surgical instruments, laboratory chemicals and diagnostics — becoming a one-stop veterinary solution provider.</p>
        </div>
      </div>

      <div class="timeline-item timeline-right" data-aos="fade-left" data-aos-delay="240">
         <div class="timeline-dot"><i class="fas fa-award"></i></div>
        <div class="timeline-card">
          <div class="timeline-year">2026</div>
          <h5 class="timeline-title">ISO Certified Quality</h5>
          <p class="timeline-desc">Achieved international quality certifications, reinforcing our commitment to supplying only verified, safe and effective veterinary healthcare products.</p>
        </div>
      </div>

       

    </div><!-- /timeline -->
  </div>
</section>

<!-- ===== PRODUCT CATEGORIES ===== -->
<section class="products-section" id="products">
  <div class="container">
    <div class="section-header text-center" data-aos="fade-up">
      <div class="section-badge">Our Products</div>
      <h2 class="section-title">Comprehensive Veterinary Product Range</h2>
      <div class="section-divider mx-auto"></div>
      <p class="text-muted mt-3 mx-auto" style="max-width:560px">From veterinary medicines to surgical instruments — everything your animal healthcare practice needs under one roof.</p>
    </div>
    <div class="row g-4">
      <?php foreach ($categories as $i => $cat): ?>
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $i * 80 ?>">
        <div class="product-cat-card">
          <?php if ($cat['image_path']): ?>
            <img src="<?= SITE_URL ?>/admin/uploads/products/<?= e($cat['image_path']) ?>" alt="<?= e($cat['name']) ?>" class="product-cat-img" loading="lazy">
          <?php else: ?>
            <img src="<?= SITE_URL ?>/assets/images/products/default-<?= $cat['id'] ?>.svg" alt="<?= e($cat['name']) ?>" class="product-cat-img" loading="lazy"
              onerror="this.src='<?= SITE_URL ?>/assets/images/products/default-1.svg'">
          <?php endif; ?>
          <div class="product-cat-overlay">
            <div class="product-cat-name"><?= e($cat['name']) ?></div>
            <div class="product-cat-desc"><?= e(mb_substr($cat['description'], 0, 120)) ?>…</div>
            <div class="product-cat-actions">
              <?php if ($cat['pdf_path']): ?>
              <a href="<?= SITE_URL ?>/admin/uploads/pdfs/<?= e($cat['pdf_path']) ?>" class="btn-cat-download" target="_blank" rel="noopener">
                <i class="fas fa-download me-1"></i>Download PDF
              </a>
              <?php endif; ?>
              <a href="<?= SITE_URL ?>/quote.php?category=<?= urlencode($cat['name']) ?>" class="btn-cat-inquiry">
                <i class="fas fa-envelope me-1"></i>Enquiry
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php if (empty($categories)): ?>
      <!-- Fallback static cards if DB empty -->
      <?php
      $staticCats = [
        ['Veterinary Medicines','fas fa-pills','Comprehensive range of antibiotics, antiparasitics, vitamins, vaccines and specialty formulations.'],
        ['Surgical Instruments','fas fa-scalpel','High-quality forceps, scalpels, scissors, retractors and complete surgical instrument sets.'],
        ['Chemicals','fas fa-flask','Laboratory-grade disinfectants, reagents, and specialty chemical compounds for diagnostics.'],
        ['Laboratories','fas fa-microscope','Diagnostic kits, testing equipment, culture media and analytical instruments.'],
        ['Health Care Products','fas fa-heart-pulse','Nutritional supplements, grooming, wound care and preventive healthcare solutions.'],
      ];
      foreach ($staticCats as $si => $sc): ?>
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $si * 80 ?>">
        <div class="product-cat-card" style="background:linear-gradient(135deg,#0F172A,#1E3A5F);">
          <div class="product-cat-overlay" style="background:none; justify-content:center; padding:2rem; text-align:center;">
            <i class="<?= $sc[1] ?> fa-3x mb-3" style="color:var(--secondary)"></i>
            <div class="product-cat-name" style="font-size:1.1rem"><?= $sc[0] ?></div>
            <div class="product-cat-desc" style="max-height:100%;opacity:1"><?= $sc[2] ?></div>
            <div class="product-cat-actions" style="transform:none;opacity:1;justify-content:center;margin-top:1rem;">
              <a href="<?= SITE_URL ?>/quote.php?category=<?= urlencode($sc[0]) ?>" class="btn-cat-inquiry">
                <i class="fas fa-envelope me-1"></i>Enquiry
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; endif; ?>
    </div>
    <div class="text-center mt-5" data-aos="fade-up">
      <a href="<?= SITE_URL ?>/products.php" class="btn-primary-hero">
        <i class="fas fa-th-large me-2"></i>View All Products
      </a>
    </div>
  </div>
</section>

<!-- ===== INDUSTRIES ===== -->
<section class="industries-section">
  <div class="container">
    <div class="section-header text-center" data-aos="fade-up">
      <div class="section-badge">Industries We Serve</div>
      <h2 class="section-title">Serving Diverse Animal Healthcare Sectors</h2>
      <div class="section-divider mx-auto"></div>
    </div>
    <?php
    $industries = [
      ['Dairy Farming','🐄','Supplying specialized medicines and nutritional products for dairy cattle health, milk production enhancement and disease prevention.','fas fa-cow'],
      ['Poultry Industry','🐔','Comprehensive vaccines, antibiotics and health solutions tailored for broiler, layer and breeder poultry farms.','fas fa-dove'],
      ['Swine Industry','🐖','Complete range of pig health products including growth promoters, vaccines and treatment protocols for profitable swine production.','fas fa-piggy-bank'],
      ['Pet Care','🐾','Premium healthcare products for companion animals including dogs, cats and exotic pets at veterinary clinics and pet hospitals.','fas fa-paw'],
      ['Equine Care','🐎','Specialized veterinary medicines and surgical instruments for equine health management and performance optimization.','fas fa-horse'],
      ['Veterinary Research','🔬','Laboratory chemicals, diagnostic kits and research-grade reagents for veterinary colleges, research institutes and diagnostic labs.','fas fa-flask'],
    ];
    ?>
    <div class="row g-4">
      <?php foreach ($industries as $i => $ind): ?>
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $i * 80 ?>">
        <div class="industry-card">
          <div class="industry-img-wrap">
            <img src="<?= SITE_URL ?>/assets/images/industries/<?= strtolower(str_replace(' ','-',$ind[0])) ?>.svg" alt="<?= e($ind[0]) ?>" loading="lazy">
          </div>
          <div class="industry-body">
            <div class="industry-icon"><i class="<?= $ind[3] ?>"></i></div>
            <h5 class="industry-title"><?= $ind[0] ?></h5>
            <p class="industry-desc"><?= $ind[2] ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center mt-5" data-aos="fade-up">
      <a href="<?= SITE_URL ?>/industries.php" class="btn-primary-hero">
        <i class="fas fa-arrow-right me-2"></i>View All Industries
      </a>
    </div>
  </div>
</section>

<!-- ===== WHY CHOOSE US ===== -->
<section class="why-section">
  <div class="container">
    <div class="section-header text-center" data-aos="fade-up">
      <div class="section-badge">Why Choose Us</div>
      <h2 class="section-title">Your Trusted Veterinary Partner</h2>
      <div class="section-divider mx-auto"></div>
    </div>
    <?php
    $whys = [
      ['fas fa-store','One Stop Veterinary Solution','Complete range of veterinary products from a single trusted source — saving your time and procurement costs.'],
      ['fas fa-certificate','Quality Assurance','All products meet international quality standards with rigorous quality control processes at every stage.'],
      ['fas fa-globe','Supply Network','Established supply chain across Northeastern India ensuring reliable product availability wherever you are.'],
      ['fas fa-truck-fast','Timely Delivery','Efficient logistics network ensuring on-time delivery of your orders across domestic and international destinations.'],
      ['fas fa-graduation-cap','Industry Expertise','Over 66+ years of deep domain expertise in veterinary healthcare guiding our product selection and support.'],
      ['fas fa-handshake','Customer Commitment','Dedicated customer support, technical guidance and after-sales assistance for long-term business partnerships.'],
    ];
    ?>
    <div class="row g-4">
      <?php foreach ($whys as $i => $w): ?>
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $i * 80 ?>">
        <div class="why-card">
          <div class="why-icon"><i class="<?= $w[0] ?>"></i></div>
          <h5 class="why-title"><?= $w[1] ?></h5>
          <p class="why-desc"><?= $w[2] ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== CTA ===== -->
<section class="cta-section">
  <div class="container text-center position-relative" data-aos="fade-up">
    <div class="section-badge mb-3">Get Started Today</div>
    <h2 class="cta-title">Ready to Source Veterinary Products?</h2>
    <p class="cta-text mx-auto" style="max-width:540px">Connect with us for customized veterinary solutions, competitive pricing and reliable supply.</p>
    <div class="d-flex flex-wrap gap-3 justify-content-center">
      <a href="<?= SITE_URL ?>/quote.php" class="btn-primary-hero">
        <i class="fas fa-file-alt me-2"></i>Get A Quote
      </a>
      <a href="<?= SITE_URL ?>/contact.php" class="btn-outline-hero">
        <i class="fas fa-phone me-2"></i>Contact Us
      </a>
    </div>
  </div>
</section>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3QBK7BBVZF"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-3QBK7BBVZF');
</script>
<?php include __DIR__ . '/includes/footer.php'; ?>
