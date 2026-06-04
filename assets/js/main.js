/* ============================================================
   main.js — Jyoti Trade Agencies
============================================================ */
$(function () {

  // ── AOS Init ──────────────────────────────
  if (typeof AOS !== 'undefined') {
    AOS.init({ duration: 700, once: true, offset: 80 });
  }

  // ── Sticky Nav ────────────────────────────
  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 80) {
      $('#mainNav').addClass('scrolled');
    } else {
      $('#mainNav').removeClass('scrolled');
    }
  });

  // ── Animated Counters ─────────────────────
  function animateCounters() {
    $('.counter-num[data-target]').each(function () {
      const $el = $(this);
      const target = parseInt($el.data('target'), 10);
      const suffix = $el.data('suffix') || '';
      let current = 0;
      const step = Math.ceil(target / 60);
      const timer = setInterval(function () {
        current += step;
        if (current >= target) {
          current = target;
          clearInterval(timer);
        }
        $el.text(current + suffix);
      }, 25);
    });
  }

  // Trigger counters when section enters viewport
  const counterDone = { fired: false };
  function checkCounters() {
    if (counterDone.fired) return;
    const $sec = $('.counters-section');
    if (!$sec.length) return;
    const top = $sec.offset().top;
    const scrollBottom = $(window).scrollTop() + $(window).height();
    if (scrollBottom > top + 80) {
      counterDone.fired = true;
      animateCounters();
    }
  }
  $(window).on('scroll', checkCounters);
  checkCounters();

  // ── Contact Form AJAX ─────────────────────
  $('#contactForm').on('submit', function (e) {
    e.preventDefault();
    const $form = $(this);
    const $btn  = $form.find('[type=submit]');
    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Sending…');
    $.ajax({
      type: 'POST',
      url: 'handlers/contact.php',
      data: $form.serialize(),
      dataType: 'json',
      success: function (data) {
        const cls  = data.success ? 'alert-success-custom' : 'alert-error-custom';
        const icon = data.success ? 'fa-check-circle'      : 'fa-exclamation-circle';
        $('#contactMsg').html('<div class="' + cls + '"><i class="fas ' + icon + ' me-2"></i>' + data.message + '</div>');
        if (data.success) $form[0].reset();
      },
      error: function () {
        $('#contactMsg').html('<div class="alert-error-custom"><i class="fas fa-exclamation-circle me-2"></i>An unexpected error occurred. Please try again.</div>');
      }
    }).always(function () {
      $btn.prop('disabled', false).html('<i class="fas fa-paper-plane me-2"></i>Send Message');
    });
  });

  // ── Quote Form AJAX ───────────────────────
  $('#quoteForm').on('submit', function (e) {
    e.preventDefault();
    const $form = $(this);
    const $btn  = $form.find('[type=submit]');
    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Submitting…');
    $.ajax({
      type: 'POST',
      url: 'handlers/quote.php',
      data: $form.serialize(),
      dataType: 'json',
      success: function (data) {
        const cls  = data.success ? 'alert-success-custom' : 'alert-error-custom';
        const icon = data.success ? 'fa-check-circle'      : 'fa-exclamation-circle';
        $('#quoteMsg').html('<div class="' + cls + '"><i class="fas ' + icon + ' me-2"></i>' + data.message + '</div>');
        if (data.success) {
          $form[0].reset();
          $('html,body').animate({ scrollTop: $('#quoteMsg').offset().top - 120 }, 500);
        }
      },
      error: function () {
        $('#quoteMsg').html('<div class="alert-error-custom"><i class="fas fa-exclamation-circle me-2"></i>An unexpected error occurred. Please try again.</div>');
      }
    }).always(function () {
      $btn.prop('disabled', false).html('<i class="fas fa-paper-plane me-2"></i>Submit Quote Request');
    });
  });

  // ── Smooth scroll anchor ──────────────────
  $('a[href^="#"]').on('click', function (e) {
    const target = $($(this).attr('href'));
    if (target.length) {
      e.preventDefault();
      $('html,body').animate({ scrollTop: target.offset().top - 80 }, 600);
    }
  });

});
