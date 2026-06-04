<?php
require_once __DIR__ . '/includes/init.php';
$metaTitle = 'About Us - ' . getSetting('company_name');
$metaDesc  = 'Learn about Jyoti Trade Agencies — our company profile, vision, mission, strengths and infrastructure as a global veterinary healthcare solutions provider.';
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<!-- Page Hero -->
<section class="page-hero">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-3">
        <li class="breadcrumb-item"><a href="<?= SITE_URL ?>/">Home</a></li>
        <li class="breadcrumb-item active">About Us</li>
      </ol>
    </nav>
    <h1 class="page-hero-title" data-aos="fade-up">About Us</h1>
    <p class="page-hero-sub" data-aos="fade-up" data-aos-delay="100">Your Trusted Global Veterinary Healthcare Partner</p>
  </div>
</section>

<!-- Company Profile -->
<section class="py-6" style="padding:5rem 0;">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6" data-aos="fade-right">
        <div class="section-badge">Company Profile</div>
        <h2 class="section-title">Who We Are</h2>
        <div class="section-divider left mb-4"></div>
        <p class="text-muted lh-lg">
          <strong>Jyoti Trade Agencies</strong> is a premier global veterinary healthcare solutions provider with over 66+ years of industry expertise. We specialize in supplying veterinary medicines, surgical instruments, laboratory chemicals, animal healthcare products and diagnostic laboratory solutions to clients in India.
        </p>
        <p class="text-muted lh-lg mt-3">
          Founded with a commitment to advancing animal healthcare, we have built lasting relationships with veterinary hospitals, dairy farms, poultry industries, government animal husbandry departments and national clients across India.
        </p>
        <p class="text-muted lh-lg mt-3">
          Our comprehensive product portfolio, stringent quality standards and dedicated customer support make us the preferred partner for businesses seeking a one-stop veterinary procurement solution.
        </p>
        <div class="d-flex gap-4 mt-4">
          <div class="text-center">
            <div style="font-size:2rem;font-weight:800;color:var(--secondary);font-family:'Poppins',sans-serif">66+</div>
            <small class="text-muted">Years Experience</small>
          </div>
          <div class="text-center">
            <div style="font-size:2rem;font-weight:800;color:var(--accent);font-family:'Poppins',sans-serif">50+</div>
            <small class="text-muted">Countries</small>
          </div>
          <div class="text-center">
            <div style="font-size:2rem;font-weight:800;color:var(--secondary);font-family:'Poppins',sans-serif">500+</div>
            <small class="text-muted">Products</small>
          </div>
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <div style="background:linear-gradient(135deg,#0F172A,#1E3A5F);border-radius:16px;padding:3rem;text-align:center;color:#fff;">
          <i class="fas fa-paw fa-5x mb-4" style="color:var(--secondary)"></i>
          <h3 style="color:#fff;margin-bottom:1rem">Global Veterinary Solutions</h3>
          <p style="color:#94A3B8;line-height:1.8">Serving veterinary professionals, farms, clinics and government departments worldwide with world-class products and unmatched service.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Vision & Mission -->
<section style="padding:4rem 0;background:#F8FAFC;">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6" data-aos="fade-up">
        <div class="about-vision-card h-100">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div style="width:50px;height:50px;background:linear-gradient(135deg,var(--secondary),var(--accent));border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.4rem;">
              <i class="fas fa-eye"></i>
            </div>
            <h4 class="mb-0">Our Vision</h4>
          </div>
          <p class="text-muted lh-lg">To be the India's most trusted and comprehensive one-stop veterinary healthcare solutions provider — empowering animal health professionals with the highest quality products and reliable supply chain.</p>
        </div>
      </div>
      <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="about-vision-card h-100">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div style="width:50px;height:50px;background:linear-gradient(135deg,var(--secondary),var(--accent));border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.4rem;">
              <i class="fas fa-bullseye"></i>
            </div>
            <h4 class="mb-0">Our Mission</h4>
          </div>
          <p class="text-muted lh-lg">To deliver innovative, high-quality veterinary medicines, instruments and healthcare solutions that improve animal health outcomes, while building long-term partnerships with our global clients through integrity, expertise and service excellence.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Our Strengths -->
<section style="padding:5rem 0;">
  <div class="container">
    <div class="section-header text-center" data-aos="fade-up">
      <div class="section-badge">Our Strengths</div>
      <h2 class="section-title">What Makes Us Different</h2>
      <div class="section-divider mx-auto"></div>
    </div>
    <?php
    $strengths = [
      ['fas fa-boxes-stacked','Comprehensive Product Portfolio','Over 500+ veterinary products spanning medicines, instruments, chemicals and laboratory solutions.'],
      ['fas fa-certificate','Quality Standards','ISO-compliant products from certified manufacturers, ensuring safety and efficacy for every product.'],
      ['fas fa-ship','Global Export Expertise','Experienced in international trade regulations, documentation and logistics for smooth global delivery.'],
      ['fas fa-headset','Technical Support','Expert team providing pre-sales technical consultation and after-sales support to our clients.'],
      ['fas fa-warehouse','Efficient Warehousing','Modern temperature-controlled warehouse facilities ensuring optimal storage and product integrity.'],
      ['fas fa-handshake-simple','Long-term Partnerships','Committed to building lasting relationships through transparency, reliability and mutual growth.'],
    ];
    ?>
    <div class="row g-4">
      <?php foreach ($strengths as $i => $s): ?>
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $i * 80 ?>">
        <div class="about-strength-item">
          <div class="about-strength-icon"><i class="<?= $s[0] ?>"></i></div>
          <div>
            <h6 class="fw-700 mb-1" style="font-weight:700"><?= $s[1] ?></h6>
            <p class="text-muted small mb-0 lh-lg"><?= $s[2] ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Infrastructure -->
<section style="padding:4rem 0 5rem;background:#F8FAFC; display: none;">
  <div class="container">
    <div class="section-header text-center" data-aos="fade-up">
      <div class="section-badge">Infrastructure</div>
      <h2 class="section-title">Our Facilities</h2>
      <div class="section-divider mx-auto"></div>
    </div>
    <?php
    $infra = [
      ['Office','fas fa-building','Our modern corporate office is equipped with state-of-the-art technology to manage global operations efficiently.'],
      ['Warehouse','fas fa-warehouse','Temperature-controlled warehousing with modern storage systems ensuring product quality and timely dispatch.'],
      ['Quality Control','fas fa-microscope','Dedicated quality control area with laboratory equipment to verify product standards before dispatch.'],
    ];
    ?>
    <div class="row g-4">
      <?php foreach ($infra as $i => $inf): ?>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
        <div class="gallery-img">
          <img src="<?= SITE_URL ?>/assets/images/about/<?= strtolower(str_replace(' ','-',$inf[0])) ?>.svg" alt="<?= e($inf[0]) ?>">
          <div class="mt-3">
            <div class="d-flex align-items-center gap-2 mb-1">
              <i class="<?= $inf[1] ?>" style="color:var(--secondary)"></i>
              <strong><?= $inf[0] ?></strong>
            </div>
            <p class="text-muted small lh-lg mb-0"><?= $inf[2] ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section">
  <div class="container text-center" data-aos="fade-up">
    <h2 class="cta-title">Partner With Us Today</h2>
    <p class="cta-text mx-auto" style="max-width:500px">Join 1000+ satisfied clients worldwide who trust Jyoti Trade Agencies for their veterinary needs.</p>
    <div class="d-flex flex-wrap gap-3 justify-content-center">
      <a href="<?= SITE_URL ?>/quote.php" class="btn-primary-hero"><i class="fas fa-file-alt me-2"></i>Get A Quote</a>
      <a href="<?= SITE_URL ?>/contact.php" class="btn-outline-hero"><i class="fas fa-phone me-2"></i>Contact Us</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
