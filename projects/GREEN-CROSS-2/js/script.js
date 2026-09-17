// ===== HAMBURGER MENU =====
const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('navLinks');

if (hamburger && navLinks) {
  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('open');
    navLinks.classList.toggle('open');
  });

  // Close menu when a link is clicked
  navLinks.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      hamburger.classList.remove('open');
      navLinks.classList.remove('open');
    });
  });
}

// ===== SCROLL ANIMATIONS (cards, service-cards, product-cards, blog-cards) =====
function animateOnScroll() {
  const items = document.querySelectorAll('.card, .service-card, .product-card, .blog-card');
  items.forEach((el, i) => {
    const top = el.getBoundingClientRect().top;
    if (top < window.innerHeight - 60) {
      setTimeout(() => el.classList.add('visible'), i * 80);
    }
  });
}

window.addEventListener('scroll', animateOnScroll);
window.addEventListener('load', animateOnScroll);

// ===== HEADER SHADOW ON SCROLL =====
window.addEventListener('scroll', () => {
  const header = document.querySelector('header');
  if (header) {
    header.style.boxShadow = window.scrollY > 20
      ? '0 4px 24px rgba(0,0,0,0.12)'
      : '0 2px 15px rgba(0,0,0,0.06)';
  }
});

// ===== HERO SLIDER WITH DOTS =====
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
let currentSlide = 0;

function showSlide(index) {
  slides.forEach(s => s.classList.remove('active'));
  dots.forEach(d => d.classList.remove('active'));
  if (slides[index]) slides[index].classList.add('active');
  if (dots[index]) dots[index].classList.add('active');
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide(currentSlide);
}

// Dot click
dots.forEach(dot => {
  dot.addEventListener('click', () => {
    currentSlide = parseInt(dot.dataset.index);
    showSlide(currentSlide);
  });
});

if (slides.length > 0) {
  setInterval(nextSlide, 4500);
}

// ===== PRODUCT FILTER BUTTONS (visual toggle only) =====
const filterBtns = document.querySelectorAll('.filter-btn');
filterBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    filterBtns.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
  });
});



// ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});





