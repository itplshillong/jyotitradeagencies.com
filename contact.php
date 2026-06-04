<?php
require_once __DIR__ . '/includes/init.php';
$metaTitle = 'Contact Us - ' . getSetting('company_name');
$metaDesc  = 'Contact Jyoti Trade Agencies for veterinary product enquiries, quotes and support. We are here to help you.';
$mapEmbed  = getSetting('map_embed');
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<section class="page-hero">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-3">
        <li class="breadcrumb-item"><a href="<?= SITE_URL ?>/">Home</a></li>
        <li class="breadcrumb-item active">Contact Us</li>
      </ol>
    </nav>
    <h1 class="page-hero-title" data-aos="fade-up">Contact Us</h1>
    <p class="page-hero-sub" data-aos="fade-up" data-aos-delay="100">We're here to help. Reach out to us for any product enquiries.</p>
  </div>
</section>

<section style="padding:5rem 0;">
  <div class="container">
    <div class="row g-4">

      <!-- Contact Info -->
      <div class="col-lg-4" data-aos="fade-right">
        <div class="contact-info-card">
          <h4 style="color:#fff;margin-bottom:2rem">Get In Touch</h4>

          <div class="contact-info-item">
            <div class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div>
              <div class="contact-info-label">Address</div>
              <div class="contact-info-val"><?= nl2br(e($companyAddr)) ?></div>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-info-icon"><i class="fas fa-phone"></i></div>
            <div>
              <div class="contact-info-label">Phone</div>
              <a href="tel:<?= e($companyPhone) ?>" class="contact-info-val" style="color:#fff"><?= e($companyPhone) ?></a>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-info-icon"><i class="fas fa-envelope"></i></div>
            <div>
              <div class="contact-info-label">Email</div>
              <a href="mailto:<?= e($companyEmail) ?>" class="contact-info-val" style="color:#fff"><?= e($companyEmail) ?></a>
            </div>
          </div>

          <div class="mt-4 p-3" style="background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.2);border-radius:10px;">
            <p style="color:#94A3B8;font-size:.875rem;margin:0;line-height:1.7">
              <i class="fas fa-clock me-2" style="color:var(--secondary)"></i>
              <strong style="color:#fff">Business Hours:</strong><br>
              Monday – Saturday: 9:00 AM – 6:00 PM<br>
              <span style="color:#64748B;">Sunday: Closed</span>
            </p>
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="col-lg-8" data-aos="fade-left">
        <div class="contact-form-card">
          <h4 class="mb-1">Send Us A Message</h4>
          <p class="text-muted small mb-4">Fill in the form below and we'll get back to you within 24 hours.</p>

          <div id="contactMsg"></div>

          <form id="contactForm" novalidate>
            <?= csrf_field() ?>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="Your full name" required maxlength="255">
              </div>
              <div class="col-md-6">
                <label class="form-label">Company Name</label>
                <input type="text" name="company_name" class="form-control" placeholder="Your company name" maxlength="255">
              </div>
              <div class="col-md-6">
                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" placeholder="you@company.com" required maxlength="255">
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="tel" name="phone" class="form-control" placeholder="+91 XXXXX XXXXX" maxlength="50">
              </div>
              <div class="col-12">
                <label class="form-label">Message <span class="text-danger">*</span></label>
                <textarea name="message" class="form-control" rows="5" placeholder="Tell us about your requirement…" required maxlength="3000"></textarea>
              </div>
              <div class="col-12">
                <button type="submit" class="btn-submit">
                  <i class="fas fa-paper-plane me-2"></i>Send Message
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>

    <!-- Map -->
    <?php if ($mapEmbed): ?>
    <div class="map-wrapper mt-5" data-aos="fade-up">
      <?= $mapEmbed ?>
    </div>
    <?php else: ?>
    <div class="map-wrapper mt-5" data-aos="fade-up">
      <div style="background:#F8FAFC;height:300px;display:flex;align-items:center;justify-content:center;border-radius:12px;border:2px dashed #E2E8F0;">
        <div class="text-center text-muted">
          <i class="fas fa-map-marked-alt fa-3x mb-3" style="color:#CBD5E1"></i>
          <p class="mb-0">Google Map will appear here after admin configuration.</p>
        </div>
      </div>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
