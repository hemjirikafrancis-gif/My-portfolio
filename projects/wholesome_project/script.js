// =============================================
// WHOLESOME LEGAL HOUSE — JS
// =============================================

document.addEventListener('DOMContentLoaded', function () {

  // ---- STICKY HEADER ----
  const header = document.getElementById('site-header');
  window.addEventListener('scroll', () => {
    header.classList.toggle('scrolled', window.scrollY > 60);
  });

  // ---- MOBILE NAV ----
  const toggle = document.getElementById('nav-toggle');
  const nav = document.getElementById('main-nav');

  toggle.addEventListener('click', () => {
    toggle.classList.toggle('open');
    nav.classList.toggle('open');
  });

  // Close nav on link click
  nav.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      toggle.classList.remove('open');
      nav.classList.remove('open');
    });
  });

  // ---- HERO SLIDER ----
  const slides = document.querySelectorAll('.hero-slide');
  const dots = document.querySelectorAll('.hero-dot');
  let current = 0;
  let autoPlay;

  function goToSlide(idx) {
    slides[current].classList.remove('active');
    dots[current].classList.remove('active');
    current = idx;
    slides[current].classList.add('active');
    dots[current].classList.add('active');
  }

  function nextSlide() {
    goToSlide((current + 1) % slides.length);
  }

  dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
      clearInterval(autoPlay);
      goToSlide(i);
      autoPlay = setInterval(nextSlide, 5500);
    });
  });

  autoPlay = setInterval(nextSlide, 5500);

  // ---- ACTIVE NAV HIGHLIGHT ON SCROLL ----
  const sections = document.querySelectorAll('section[id], div[id]');
  const navLinks = document.querySelectorAll('.main-nav ul li a');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        navLinks.forEach(link => {
          link.classList.remove('active');
          if (link.getAttribute('href') === '#' + entry.target.id) {
            link.classList.add('active');
          }
        });
      }
    });
  }, { rootMargin: '-40% 0px -55% 0px' });

  sections.forEach(s => observer.observe(s));

  // ---- SMOOTH SCROLL ----
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        const offset = 80;
        const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    });
  });

  // ---- SCROLL REVEAL ANIMATION ----
  const revealEls = document.querySelectorAll(
    '.mvb-card, .service-card, .team-card, .testi-card, .blog-card, .about-content, .about-images, .contact-item'
  );

  const revealObs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
        revealObs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

  revealEls.forEach((el, i) => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(28px)';
    el.style.transition = `opacity 0.55s ease ${(i % 4) * 0.1}s, transform 0.55s ease ${(i % 4) * 0.1}s`;
    revealObs.observe(el);
  });
});