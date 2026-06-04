<?php
require_once __DIR__ . '/includes/init.php';
$metaTitle = 'Industries We Serve - ' . getSetting('company_name');
$metaDesc  = 'Jyoti Trade Agencies serves dairy farms, poultry industry, swine sector, pet care, equine care and veterinary research globally.';
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<section class="page-hero">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-3">
        <li class="breadcrumb-item"><a href="<?= SITE_URL ?>/">Home</a></li>
        <li class="breadcrumb-item active">Industries We Serve</li>
      </ol>
    </nav>
    <h1 class="page-hero-title" data-aos="fade-up">Industries We Serve</h1>
    <p class="page-hero-sub" data-aos="fade-up" data-aos-delay="100">Delivering tailored veterinary solutions across diverse animal healthcare sectors</p>
  </div>
</section>

<section style="padding:5rem 0;">
  <div class="container">

    <?php
    $industries = [
      [
        'dairy-farming','Dairy Farming','fas fa-cow',
        'The dairy sector demands reliable, high-quality veterinary products to maintain herd health, productivity and milk safety. Jyoti Trade Agencies supplies a comprehensive range of antibiotics, reproductive hormones, vitamins, minerals, mastitis control products, anthelmintics and hoof care solutions specifically formulated for dairy cattle management.',
        ['Mastitis Control Products','Reproductive Hormones','Tick & Fly Control','Nutritional Supplements','Herd Health Programs','Milk Quality Products']
      ],
      [
        'poultry-industry','Poultry Industry','fas fa-dove',
        'Modern poultry production requires effective disease prevention and health management protocols. We offer comprehensive vaccines, antibiotics, coccidiostats, growth promoters, enzymes and supportive care products for broiler, layer, breeder and turkey farms worldwide.',
        ['Poultry Vaccines','Anti-coccidials','Growth Promoters','Respiratory Treatments','Water Sanitizers','Immunostimulants']
      ],
      [
        'swine-industry','Swine Industry','fas fa-piggy-bank',
        'Pig farming profitability depends heavily on disease management and optimal growth performance. Our swine product range includes vaccines for key diseases, antibiotics, anti-inflammatory drugs, growth-promoting feed additives and comprehensive health management solutions for all stages of pig production.',
        ['Swine Vaccines','PRRS Management','Respiratory Solutions','Reproductive Products','Growth Additives','Parasite Control']
      ],
      [
        'pet-care','Pet Care','fas fa-paw',
        'Veterinary clinics, pet hospitals and pet care professionals require premium healthcare products for companion animals. We supply a broad range of pet medicines, ectoparasiticides, dental care, nutritional supplements and surgical instruments for dogs, cats, rabbits and exotic animals.',
        ['Anti-parasiticides','Dental Care','Dermatology Products','Nutritional Support','Surgical Instruments','Diagnostic Kits']
      ],
      [
        'equine-care','Equine Care','fas fa-horse',
        'Performance horses and working equines require specialized veterinary attention. Our equine product range covers anti-inflammatory drugs, joint care supplements, anthelmintics, wound care, performance nutrition and specialized surgical instruments designed for equine veterinary practice.',
        ['Joint Care Supplements','Anti-inflammatories','Equine Dewormers','Performance Nutrition','Wound Management','Reproductive Products']
      ],
      [
        'veterinary-research','Veterinary Research','fas fa-microscope',
        'Veterinary colleges, research institutions and diagnostic laboratories require high-quality laboratory chemicals, reagents, culture media and diagnostic equipment. We provide research-grade chemicals, ELISA kits, PCR reagents, microbiological media and laboratory instruments to support veterinary science advancement.',
        ['Laboratory Chemicals','Diagnostic Kits','Culture Media','PCR Reagents','Research Equipment','Analytical Instruments']
      ],
    ];
    ?>

    <?php foreach ($industries as $i => $ind): ?>
    <div class="row g-5 align-items-center <?= ($i % 2 !== 0) ? 'flex-row-reverse' : '' ?>"
         id="<?= $ind[0] ?>"
         style="margin-bottom:5rem;padding-bottom:4rem;<?= ($i < count($industries)-1) ? 'border-bottom:1px solid #E2E8F0' : '' ?>"
         data-aos="fade-up">
      <div class="col-lg-5">
        <div style="border-radius:16px;overflow:hidden;box-shadow:0 12px 40px rgba(15,23,42,.1)">
          <img src="<?= SITE_URL ?>/assets/images/industries/<?= $ind[0] ?>.svg" alt="<?= e($ind[1]) ?>" style="width:100%;height:360px;object-fit:cover" loading="lazy">
        </div>
      </div>
      <div class="col-lg-7">
        <div class="d-flex align-items-center gap-3 mb-3">
          <div style="width:50px;height:50px;background:linear-gradient(135deg,var(--secondary),var(--accent));border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.3rem;">
            <i class="<?= $ind[2] ?>"></i>
          </div>
          <div class="section-badge mb-0"><?= $ind[1] ?></div>
        </div>
        <h2 class="section-title"><?= $ind[1] ?></h2>
        <div class="section-divider left mb-4"></div>
        <p class="text-muted lh-lg"><?= $ind[3] ?></p>
        <div class="mt-4">
          <h6 class="fw-bold mb-3" style="font-size:.85rem;text-transform:uppercase;letter-spacing:.06em;color:#64748B">Key Products</h6>
          <div class="d-flex flex-wrap gap-2">
            <?php foreach ($ind[4] as $tag): ?>
            <span style="background:rgba(16,185,129,.08);color:var(--secondary);border:1px solid rgba(16,185,129,.2);padding:.3rem .85rem;border-radius:20px;font-size:.8rem;font-weight:600"><?= $tag ?></span>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="mt-4">
          <a href="<?= SITE_URL ?>/quote.php" class="btn-primary-hero" style="font-size:.9rem;padding:.7rem 1.5rem">
            <i class="fas fa-file-alt me-2"></i>Request Quote
          </a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>

  </div>
</section>

<!-- Who We Supply To -->
<section style="padding:4rem 0 5rem;background:#F8FAFC;">
  <div class="container">
    <div class="section-header text-center" data-aos="fade-up">
      <div class="section-badge">Our Clients</div>
      <h2 class="section-title">Who We Supply To</h2>
      <div class="section-divider mx-auto"></div>
    </div>
    <?php
    $clients = [
      ['fas fa-hospital','Veterinary Hospitals'],
      ['fas fa-building-columns','Animal Healthcare Companies'],
      ['fas fa-cow','Dairy Farms'],
      ['fas fa-dove','Poultry Farms'],
      ['fas fa-piggy-bank','Pig Farms'],
      ['fas fa-paw','Pet Clinics'],
      ['fas fa-truck','Veterinary Distributors'],
      ['fas fa-landmark','Government Animal Husbandry'],
      ['fas fa-globe','International Buyers'],
    ];
    ?>
    <div class="row g-3 justify-content-center">
      <?php foreach ($clients as $i => $cl): ?>
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 80 ?>">
        <div style="background:#fff;border:1px solid #E2E8F0;border-radius:12px;padding:1.25rem 1.5rem;display:flex;align-items:center;gap:1rem;transition:all .3s" class="client-item">
          <div style="width:44px;height:44px;min-width:44px;background:linear-gradient(135deg,rgba(16,185,129,.1),rgba(14,165,233,.1));border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--secondary);font-size:1.1rem;">
            <i class="<?= $cl[0] ?>"></i>
          </div>
          <span style="font-weight:600;font-size:.9rem"><?= $cl[1] ?></span>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="cta-section">
  <div class="container text-center" data-aos="fade-up">
    <h2 class="cta-title">Serving Your Industry With Excellence</h2>
    <p class="cta-text mx-auto" style="max-width:500px">Tell us your industry requirements and we will provide the most suitable veterinary product solutions.</p>
    <a href="<?= SITE_URL ?>/quote.php" class="btn-primary-hero"><i class="fas fa-file-alt me-2"></i>Get A Quote</a>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
