document.addEventListener("DOMContentLoaded", function () {

  /* ---------- Mobile nav toggle ---------- */
  var navToggle = document.getElementById("navToggle");
  var mainNav = document.getElementById("main-nav");

  navToggle.addEventListener("click", function () {
    var isOpen = mainNav.classList.toggle("is-open");
    navToggle.classList.toggle("is-open", isOpen);
    navToggle.setAttribute("aria-expanded", isOpen);
  });

  document.querySelectorAll(".nav-link").forEach(function (link) {
    link.addEventListener("click", function () {
      mainNav.classList.remove("is-open");
      navToggle.classList.remove("is-open");
      navToggle.setAttribute("aria-expanded", "false");
    });
  });

  /* ---------- Scrollspy: highlight active nav link ---------- */
  var sections = document.querySelectorAll("section[id]");
  var navLinks = document.querySelectorAll(".nav-link");

  function onScrollSpy() {
    var scrollPos = window.scrollY + 140;
    var current = "";
    sections.forEach(function (sec) {
      if (scrollPos >= sec.offsetTop) current = sec.getAttribute("id");
    });
    navLinks.forEach(function (link) {
      link.classList.toggle("is-active", link.getAttribute("href") === "#" + current);
    });
  }
  window.addEventListener("scroll", onScrollSpy, { passive: true });
  onScrollSpy();

  /* ---------- Back to top button ---------- */
  var toTop = document.getElementById("toTop");
  window.addEventListener("scroll", function () {
    toTop.classList.toggle("is-visible", window.scrollY > 700);
  }, { passive: true });
  toTop.addEventListener("click", function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  /* ---------- Header shrink shadow on scroll ---------- */
  var header = document.querySelector(".site-header");
  window.addEventListener("scroll", function () {
    header.style.boxShadow = window.scrollY > 12 ? "0 8px 24px -18px rgba(27,29,16,.5)" : "none";
  }, { passive: true });

  /* ---------- Reveal-on-scroll ---------- */
  var revealEls = document.querySelectorAll(".reveal");
  var revealObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add("is-visible");
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15, rootMargin: "0px 0px -60px 0px" });
  revealEls.forEach(function (el) { revealObserver.observe(el); });

  /* ---------- Counter animation ---------- */
  function animateCounter(el) {
    var target = parseInt(el.getAttribute("data-target"), 10);
    var suffix = el.getAttribute("data-suffix") || "";
    var duration = 1600;
    var startTime = null;

    function step(timestamp) {
      if (!startTime) startTime = timestamp;
      var progress = Math.min((timestamp - startTime) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      var value = Math.floor(eased * target);
      el.textContent = value.toLocaleString() + suffix;
      if (progress < 1) {
        requestAnimationFrame(step);
      } else {
        el.textContent = target.toLocaleString() + suffix;
      }
    }
    requestAnimationFrame(step);
  }

  var statNums = document.querySelectorAll(".stat-num");
  var statObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        statObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });
  statNums.forEach(function (el) { statObserver.observe(el); });

  /* ---------- Wheat stalk draw-in (About section) ---------- */
  var figureFrame = document.querySelector(".figure-frame");
  if (figureFrame) {
    var figureObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-drawn");
          figureObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.3 });
    figureObserver.observe(figureFrame);
  }

  /* ---------- Org chart line draw-in ---------- */
  var orgChart = document.getElementById("orgChart");
  if (orgChart) {
    var orgObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-drawn");
          orgObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.25 });
    orgObserver.observe(orgChart);
  }

  /* ---------- Objectives accordion ---------- */
  var accItems = document.querySelectorAll(".acc-item");
  accItems.forEach(function (item) {
    var head = item.querySelector(".acc-head");
    head.addEventListener("click", function () {
      var wasOpen = item.classList.contains("is-open");
      accItems.forEach(function (i) { i.classList.remove("is-open"); });
      if (!wasOpen) item.classList.add("is-open");
    });
  });

  /* ---------- Contact form (submits to database via submit-contact.php) ---------- */
  var contactForm = document.getElementById("contactForm");
  var formNote = document.getElementById("formNote");
  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      e.preventDefault();

      var submitBtn = contactForm.querySelector("button[type='submit']");
      if (submitBtn) submitBtn.disabled = true;
      formNote.textContent = "Sending...";

      var formData = new FormData(contactForm);

      fetch("submit-contact.php", {
        method: "POST",
        body: formData
      })
        .then(function (res) { return res.json(); })
        .then(function (data) {
          formNote.textContent = data.message;
          if (data.success) {
            contactForm.reset();
          }
        })
        .catch(function () {
          formNote.textContent = "Something went wrong. Please try again.";
        })
        .finally(function () {
          if (submitBtn) submitBtn.disabled = false;
        });
    });
  }

});
