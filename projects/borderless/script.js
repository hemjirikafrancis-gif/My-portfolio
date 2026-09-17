/* ============================================================
   BORDERLESS ANALYSTS - MAIN JAVASCRIPT
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

  /* ===== HAMBURGER / MOBILE MENU ===== */
  const hamburger = document.getElementById('hamburger');
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileClose = document.getElementById('mobile-close');

  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', () => {
      mobileMenu.classList.add('open');
      document.body.style.overflow = 'hidden';
    });
  }
  if (mobileClose && mobileMenu) {
    mobileClose.addEventListener('click', () => {
      mobileMenu.classList.remove('open');
      document.body.style.overflow = '';
    });
  }

  /* ===== STICKY HEADER SHADOW ===== */
  const header = document.getElementById('site-header');
  const onScroll = () => {
    if (!header) return;
    if (window.scrollY > 50) {
      header.style.boxShadow = '0 4px 24px rgba(10,46,92,0.18)';
    } else {
      header.style.boxShadow = '0 2px 12px rgba(10,46,92,0.10)';
    }

    /* scroll-top visibility */
    const scrollBtn = document.getElementById('scroll-top');
    if (scrollBtn) {
      scrollBtn.classList.toggle('show', window.scrollY > 400);
    }
  };
  window.addEventListener('scroll', onScroll, { passive: true });

  /* ===== SCROLL TO TOP ===== */
  const scrollBtn = document.getElementById('scroll-top');
  if (scrollBtn) {
    scrollBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ===== ACCORDION ===== */
  document.querySelectorAll('.accordion-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.parentElement;
      const isOpen = item.classList.contains('open');

      // Close all
      document.querySelectorAll('.accordion-item').forEach(i => i.classList.remove('open'));

      // Open clicked (toggle)
      if (!isOpen) item.classList.add('open');
    });
  });

  /* ===== FADE-UP ON SCROLL ===== */
  const fadeEls = document.querySelectorAll('.fade-up');
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
    fadeEls.forEach(el => observer.observe(el));
  } else {
    fadeEls.forEach(el => el.classList.add('visible'));
  }

  /* ===== ANIMATED COUNTER ===== */
  const counters = document.querySelectorAll('.hstat-num, .stat-num, .about-stat-num');
  const animateCounter = (el) => {
    const target = el.textContent.trim();
    // Only animate purely numeric values
    const numMatch = target.match(/^([\d.]+)([%Mx+]*)$/);
    if (!numMatch) return;
    const end = parseFloat(numMatch[1]);
    const suffix = numMatch[2] || '';
    const duration = 1500;
    const step = 16;
    const steps = duration / step;
    const increment = end / steps;
    let current = 0;
    const timer = setInterval(() => {
      current += increment;
      if (current >= end) {
        current = end;
        clearInterval(timer);
      }
      el.textContent = (Number.isInteger(end) ? Math.round(current) : current.toFixed(1)) + suffix;
    }, step);
  };

  if ('IntersectionObserver' in window) {
    const cObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          cObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });
    counters.forEach(el => cObserver.observe(el));
  }

  /* ===== SMOOTH ANCHOR SCROLLING ===== */
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      if (href === '#') return;
      const target = document.querySelector(href);
      if (target) {
        e.preventDefault();
        const offset = 90;
        const top = target.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top, behavior: 'smooth' });
        // Close mobile menu if open
        if (mobileMenu) {
          mobileMenu.classList.remove('open');
          document.body.style.overflow = '';
        }
      }
    });
  });

  /* ===== CONTACT FORM (no-backend graceful handler) ===== */
  const forms = document.querySelectorAll('.contact-form-wrap form, form');
  forms.forEach(form => {
    if (form) {
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        const btn = form.querySelector('button[type="submit"]') || form.querySelector('button');
        if (btn) {
          btn.textContent = '✓ Message Sent!';
          btn.style.background = '#22c55e';
          setTimeout(() => {
            btn.textContent = 'Send Message';
            btn.style.background = '';
            form.reset();
          }, 3000);
        }
      });
    }
  });

  /* ===== SEND MESSAGE BUTTON (non-form) ===== */
  document.querySelectorAll('.contact-form-wrap .btn').forEach(btn => {
    if (btn.tagName === 'BUTTON') {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const wrap = btn.closest('.contact-form-wrap');
        const inputs = wrap ? wrap.querySelectorAll('input, textarea') : [];
        let allFilled = true;
        inputs.forEach(inp => { if (!inp.value.trim()) allFilled = false; });
        if (allFilled) {
          const orig = btn.textContent;
          btn.textContent = '✓ Message Sent! We\'ll be in touch.';
          btn.style.background = '#22c55e';
          setTimeout(() => {
            btn.textContent = orig;
            btn.style.background = '';
            inputs.forEach(inp => inp.value = '');
          }, 3500);
        } else {
          btn.textContent = 'Please fill in all fields';
          btn.style.background = '#ef4444';
          setTimeout(() => {
            btn.textContent = 'Send Message';
            btn.style.background = '';
          }, 2500);
        }
      });
    }
  });

  /* ===== STAGGER ANIMATION for CARDS ===== */
  document.querySelectorAll('.ai-cards, .services-grid, .benefits-grid, .industries-grid, .blog-grid').forEach(grid => {
    const cards = grid.querySelectorAll('.ai-card, .service-card, .benefit-item, .industry-card, .blog-card, .sai-card');
    cards.forEach((card, i) => {
      card.style.transitionDelay = `${i * 0.07}s`;
    });
  });

});
