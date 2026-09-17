/* ==========================================================================
   HEMJIRIKA'S PHARMACEUTICALS — MAIN.JS
   Handles: header shrink-on-scroll, mobile nav toggle, active-link tracking,
   hero slider (autoplay + dots + swipe), scroll-reveal animations.
   ========================================================================== */
document.addEventListener('DOMContentLoaded', function () {

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- Header shrink on scroll ---------- */
  var header = document.querySelector('.site-header');
  function onScroll() {
    if (!header) return;
    if (window.scrollY > 24) header.classList.add('is-scrolled');
    else header.classList.remove('is-scrolled');
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* ---------- Mobile nav toggle ---------- */
  var toggle = document.querySelector('.nav-toggle');
  var navMenu = document.querySelector('.nav-menu');
  if (toggle && navMenu) {
    toggle.addEventListener('click', function () {
      toggle.classList.toggle('is-open');
      navMenu.classList.toggle('is-open');
      var expanded = toggle.classList.contains('is-open');
      toggle.setAttribute('aria-expanded', expanded);
      document.body.classList.toggle('nav-open', expanded);
    });
    navMenu.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        toggle.classList.remove('is-open');
        navMenu.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('nav-open');
      });
    });
  }

  /* ---------- Smooth-scroll anchor links with header offset ---------- */
  var headerEl = document.querySelector('.site-header');
  document.querySelectorAll('a[href*="#"]').forEach(function (link) {
    link.addEventListener('click', function (e) {
      var url = new URL(link.href, window.location.href);
      var samePage = url.pathname === window.location.pathname;
      var hash = url.hash;
      if (samePage && hash) {
        var target = document.querySelector(hash);
        if (target) {
          e.preventDefault();
          var offset = headerEl ? headerEl.offsetHeight : 0;
          var top = target.getBoundingClientRect().top + window.pageYOffset - offset + 1;
          window.scrollTo({ top: top, behavior: reduceMotion ? 'auto' : 'smooth' });
          history.pushState(null, '', hash);
        }
      }
    });
  });

  /* ---------- Active nav link on scroll ---------- */
  var sections = document.querySelectorAll('main section[id]');
  var navAnchors = document.querySelectorAll('.nav-links a[href*="#"]');
  if (sections.length && navAnchors.length) {
    var spy = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var id = entry.target.getAttribute('id');
          navAnchors.forEach(function (a) {
            a.classList.toggle('is-active', a.getAttribute('href').indexOf('#' + id) !== -1);
          });
        }
      });
    }, { rootMargin: '-45% 0px -45% 0px' });
    sections.forEach(function (s) { spy.observe(s); });
  }

  /* ---------- Scroll reveal ---------- */
  var revealEls = document.querySelectorAll('[data-reveal]');
  if (revealEls.length) {
    var revealer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var delay = entry.target.getAttribute('data-reveal-delay') || 0;
          setTimeout(function () { entry.target.classList.add('is-visible'); }, delay);
          revealer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });
    revealEls.forEach(function (el) { revealer.observe(el); });
  }

  /* ---------- Hero specimen slider ---------- */
  var slider = document.querySelector('.specimen-frame');
  if (slider) {
    var slides = slider.querySelectorAll('.slide');
    var dots = slider.querySelectorAll('.slider-dots button');
    var current = 0;
    var timer = null;
    var INTERVAL = 5200;

    function goTo(index) {
      slides[current].classList.remove('is-active');
      dots[current] && dots[current].classList.remove('is-active');
      current = (index + slides.length) % slides.length;
      slides[current].classList.add('is-active');
      dots[current] && dots[current].classList.add('is-active');
    }
    function next() { goTo(current + 1); }
    function start() {
      if (reduceMotion) return;
      stop();
      timer = setInterval(next, INTERVAL);
    }
    function stop() { if (timer) clearInterval(timer); }

    dots.forEach(function (dot, i) {
      dot.addEventListener('click', function () { goTo(i); start(); });
    });
    slider.addEventListener('mouseenter', stop);
    slider.addEventListener('mouseleave', start);

    /* basic swipe support */
    var touchX = null;
    slider.addEventListener('touchstart', function (e) { touchX = e.touches[0].clientX; }, { passive: true });
    slider.addEventListener('touchend', function (e) {
      if (touchX === null) return;
      var delta = e.changedTouches[0].clientX - touchX;
      if (Math.abs(delta) > 40) { delta < 0 ? next() : goTo(current - 1); }
      touchX = null;
    }, { passive: true });

    start();
  }

  /* ---------- Contact form (submits to database via mail-handler.php) ---------- */
  var form = document.querySelector('#contact-form');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var feedback = form.querySelector('.form-feedback');
      var submitBtn = form.querySelector('button[type="submit"]');
      if (submitBtn) submitBtn.disabled = true;
      if (feedback) feedback.textContent = 'Sending...';

      var formData = new FormData(form);

      fetch(form.getAttribute('action'), {
        method: 'POST',
        body: formData
      })
        .then(function (res) { return res.json(); })
        .then(function (data) {
          if (feedback) feedback.textContent = data.message;
          if (data.success) form.reset();
        })
        .catch(function () {
          if (feedback) feedback.textContent = 'Something went wrong. Please try again.';
        })
        .finally(function () {
          if (submitBtn) submitBtn.disabled = false;
        });
    });
  }

  /* ---------- Prescription upload (drag & drop + async submit) ---------- */
  var dropzone = document.querySelector('#rx-dropzone');
  var rxFile = document.querySelector('#rx-file');
  var rxFilelist = document.querySelector('#rx-filelist');
  var rxForm = document.querySelector('#rx-form');
  var rxFeedback = document.querySelector('#rx-feedback');

  function formatBytes(bytes) {
    if (bytes < 1024) return bytes + ' B';
    if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(0) + ' KB';
    return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
  }

  function renderFileList(files) {
    if (!rxFilelist) return;
    rxFilelist.innerHTML = '';
    Array.prototype.forEach.call(files, function (f) {
      var chip = document.createElement('div');
      chip.className = 'rx-file-chip';
      chip.innerHTML = '<span>' + f.name + '</span><span>' + formatBytes(f.size) + '</span>';
      rxFilelist.appendChild(chip);
    });
  }

  if (dropzone && rxFile) {
    rxFile.addEventListener('change', function () {
      renderFileList(rxFile.files);
    });
    ['dragenter', 'dragover'].forEach(function (evt) {
      dropzone.addEventListener(evt, function (e) {
        e.preventDefault();
        dropzone.classList.add('is-dragover');
      });
    });
    ['dragleave', 'drop'].forEach(function (evt) {
      dropzone.addEventListener(evt, function (e) {
        e.preventDefault();
        dropzone.classList.remove('is-dragover');
      });
    });
    dropzone.addEventListener('drop', function (e) {
      var dropped = e.dataTransfer && e.dataTransfer.files;
      if (dropped && dropped.length) {
        rxFile.files = dropped;
        renderFileList(rxFile.files);
      }
    });
  }

  if (rxForm) {
    rxForm.addEventListener('submit', function (e) {
      e.preventDefault();
      if (!rxFeedback) return;

      var submitBtn = rxForm.querySelector('button[type="submit"]');
      var originalLabel = submitBtn ? submitBtn.innerHTML : '';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Sending…';
      }
      rxFeedback.className = 'rx-form-feedback';

      fetch(rxForm.getAttribute('action'), {
        method: 'POST',
        body: new FormData(rxForm),
        headers: { 'X-Requested-With': 'fetch' }
      })
        .then(function (res) { return res.json(); })
        .then(function (data) {
          rxFeedback.textContent = data.message || (data.ok ? 'Submitted.' : 'Something went wrong.');
          rxFeedback.classList.add('is-visible', data.ok ? 'is-success' : 'is-error');
          if (data.ok) {
            rxForm.reset();
            if (rxFilelist) rxFilelist.innerHTML = '';
          }
        })
        .catch(function () {
          rxFeedback.textContent = 'We could not reach the server. Please check your connection and try again.';
          rxFeedback.classList.add('is-visible', 'is-error');
        })
        .finally(function () {
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalLabel;
          }
        });
    });
  }

  /* ---------- Category page: sticky nav active-state on scroll ---------- */
  var categoryBlocks = document.querySelectorAll('.category-block[id]');
  var categoryNavLinks = document.querySelectorAll('.category-nav a[href*="#"]');
  if (categoryBlocks.length && categoryNavLinks.length) {
    var categorySpy = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var id = entry.target.getAttribute('id');
          categoryNavLinks.forEach(function (a) {
            a.classList.toggle('is-active', a.getAttribute('href').indexOf('#' + id) !== -1);
          });
        }
      });
    }, { rootMargin: '-30% 0px -55% 0px' });
    categoryBlocks.forEach(function (b) { categorySpy.observe(b); });
  }
});
