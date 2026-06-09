<!-- ===== FOOTER ===== -->
<footer class="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row g-5">

        <!-- Brand Col -->
        <div class="col-lg-4 col-md-6">
          <div class="footer-brand mb-3">
            <i class="fas fa-paw me-2"></i><?= e($companyName) ?>
          </div>
          <p class="footer-desc">Your trusted global partner for veterinary medicines, surgical instruments, chemicals, laboratory products and healthcare solutions.</p>
          <ul class="footer-contact-list mt-4">
            <li><i class="fas fa-map-marker-alt"></i><?= e($companyAddr) ?></li>
            <li><i class="fas fa-phone"></i><a href="tel:<?= e($companyPhone) ?>"><?= e($companyPhone) ?></a></li>
            <li><i class="fas fa-envelope"></i><a href="mailto:<?= e($companyEmail) ?>"><?= e($companyEmail) ?></a></li>
          </ul>
        </div>

        <!-- Quick Links -->
        <div class="col-lg-2 col-md-6">
          <h5 class="footer-heading">Quick Links</h5>
          <ul class="footer-links">
            <li><a href="<?= SITE_URL ?>/">Home</a></li>
            <li><a href="<?= SITE_URL ?>/about.php">About Us</a></li>
            <li><a href="<?= SITE_URL ?>/products.php">Products</a></li>
            <li><a href="<?= SITE_URL ?>/industries.php">Industries We Serve</a></li>
            <li><a href="<?= SITE_URL ?>/contact.php">Contact Us</a></li>
            <li><a href="<?= SITE_URL ?>/quote.php">Get A Quote</a></li>
          </ul>
        </div>

        <!-- Products -->
        <div class="col-lg-3 col-md-6">
          <h5 class="footer-heading">Our Products</h5>
          <ul class="footer-links">
            <li><a href="<?= SITE_URL ?>/products.php#veterinary-medicines">Veterinary Medicines</a></li>
            <li><a href="<?= SITE_URL ?>/products.php#surgical-instruments">Surgical Instruments</a></li>
            <li><a href="<?= SITE_URL ?>/products.php#chemicals">Chemicals</a></li>
            <li><a href="<?= SITE_URL ?>/products.php#laboratories">Laboratories</a></li>
            <li><a href="<?= SITE_URL ?>/products.php#animal-health-care">Animal Health Care</a></li>
          </ul>
        </div>

        <!-- Industries -->
        <div class="col-lg-3 col-md-6">
          <h5 class="footer-heading">Industries We Serve</h5>
          <ul class="footer-links">
            <li><a href="<?= SITE_URL ?>/industries.php">Dairy Farming</a></li>
            <li><a href="<?= SITE_URL ?>/industries.php">Poultry Industry</a></li>
            <li><a href="<?= SITE_URL ?>/industries.php">Swine Industry</a></li>
            <li><a href="<?= SITE_URL ?>/industries.php">Pet Care</a></li>
            <li><a href="<?= SITE_URL ?>/industries.php">Equine Care</a></li>
            <li><a href="<?= SITE_URL ?>/industries.php">Veterinary Research</a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
        <p class="mb-0">&copy; <?= date('Y') ?> <?= e($companyName) ?>. All Rights Reserved.</p>
        <p class="mb-0  float-right small">Powered by <a href="https://techz.in" target="_blank" rel="noopener noreferrer">Iewduh Techz Private Limited</a></p>
      </div>
    </div>
  </div>
</footer>

<?php
$_waNumber = preg_replace('/[^0-9]/', '', getSetting('whatsapp_number') ?? '');
if (!empty($_waNumber)):
?>
<!-- WhatsApp Floating Button -->
<a href="https://wa.me/<?= e($_waNumber) ?>?text=<?= urlencode('Hello, I am interested in your veterinary products. Please share more details.') ?>" 
   class="whatsapp-float" 
   target="_blank" 
   rel="noopener noreferrer"
   aria-label="Chat with us on WhatsApp">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="30" height="30" aria-hidden="true">
    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
    <path d="M12 0C5.373 0 0 5.373 0 12c0 2.116.554 4.103 1.523 5.824L.057 23.882a.5.5 0 0 0 .611.612l6.198-1.457A11.934 11.934 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.882a9.871 9.871 0 0 1-5.031-1.378l-.36-.214-3.733.878.894-3.63-.234-.374A9.869 9.869 0 0 1 2.118 12C2.118 6.534 6.534 2.118 12 2.118c5.465 0 9.882 4.416 9.882 9.882 0 5.465-4.417 9.882-9.882 9.882z"/>
  </svg>
  <span class="whatsapp-float__tooltip">Chat on WhatsApp</span>
</a>
<?php endif; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<!-- Custom JS -->
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
 
</body>
</html>
