/* =========================================================
   F.H PORTFOLIO — interactions
   ========================================================= */

document.addEventListener('DOMContentLoaded', function () {

  /* ---------- Navbar scroll state ---------- */
  var navbar = document.querySelector('.navbar');
  var onScroll = function () {
    if (window.scrollY > 24) {
      navbar.classList.add('is-scrolled');
    } else {
      navbar.classList.remove('is-scrolled');
    }
  };
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* ---------- Mobile nav drawer ---------- */
  var toggle = document.querySelector('.nav-toggle');
  var drawer = document.querySelector('.nav-drawer');
  if (toggle && drawer) {
    toggle.addEventListener('click', function () {
      toggle.classList.toggle('is-open');
      drawer.classList.toggle('is-open');
    });
    drawer.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        toggle.classList.remove('is-open');
        drawer.classList.remove('is-open');
      });
    });
  }

  /* ---------- Active link highlight on scroll ---------- */
  var sections = document.querySelectorAll('section[id]');
  var navAnchors = document.querySelectorAll('.nav-links a, .nav-drawer a');

  var setActive = function (id) {
    navAnchors.forEach(function (a) {
      a.classList.toggle('active', a.getAttribute('href') === '#' + id);
    });
  };

  if ('IntersectionObserver' in window && sections.length) {
    var navObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          setActive(entry.target.id);
        }
      });
    }, { rootMargin: '-45% 0px -45% 0px', threshold: 0 });

    sections.forEach(function (sec) { navObserver.observe(sec); });
  }

  /* ---------- Scroll reveal ---------- */
  var revealEls = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window && revealEls.length) {
    var revealObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });

    revealEls.forEach(function (el, i) {
      el.style.setProperty('--i', i % 8);
      revealObserver.observe(el);
    });
  } else {
    revealEls.forEach(function (el) { el.classList.add('in-view'); });
  }

  /* ---------- Skill tabs ---------- */
  var tabs = document.querySelectorAll('.skill-tab');
  var panels = document.querySelectorAll('.skill-panel');
  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      var target = tab.getAttribute('data-target');

      tabs.forEach(function (t) { t.classList.remove('active'); });
      tab.classList.add('active');

      panels.forEach(function (panel) {
        panel.classList.toggle('active', panel.id === target);
      });
    });
  });

  /* ---------- Contact form ---------- */
  // Submits normally to contact.php, which sends the message via
  // PHPMailer (see includes/contact-handler.php + includes/mail-config.php).
  // Only blocked here if action is missing/blank, as a safety net.
  var form = document.querySelector('.contact-form');
  if (form) {
    form.addEventListener('submit', function (e) {
      var action = form.getAttribute('action');
      if (!action || action === '#') {
        e.preventDefault();
      }
    });
  }

});
