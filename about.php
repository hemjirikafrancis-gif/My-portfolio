<?php
$pageTitle = 'About';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- ======================= PAGE HERO ======================= -->
<section class="page-hero">
  <div class="container">
    <div class="eyebrow">// About</div>
    <h1>The developer behind the code.</h1>
    <p>A closer look at how I got here, how I work, and what I actually care about when I build a site.</p>
  </div>
</section>

<!-- ======================= ABOUT / STORY ======================= -->
<section class="about">
  <div class="container about-grid">

    <div class="about-figure reveal">
      <div class="about-blob">
        <img src="images/profile.jpg" alt="Francis, web developer">
      </div>
      <div class="tag-float">
        <b>Intermediate</b>
        still learning, still shipping
      </div>
    </div>

    <div class="about-copy">
      <div class="eyebrow">// My story</div>
      <h2 class="reveal" style="font-family:var(--font-display); font-size:clamp(1.9rem,4vw,2.6rem); font-weight:600; margin-bottom:28px; line-height:1.2;">
        Hi, I'm Francis
      </h2>

      <p class="reveal">
        I'm a self-taught, <strong>intermediate-level web developer</strong> who works comfortably
        across the front end and the back end. My toolkit is HTML, CSS, and JavaScript for
        everything a visitor sees and touches, and PHP with MySQL for everything that happens
        quietly behind the scenes &mdash; sessions, forms, databases, and the logic that holds a
        site together after the design is done.
      </p>

      <p class="reveal">
        Most of my projects start the same way: a client with a real business and no website
        that reflects it. I've built for a farm brand that needed a digital presence as
        trustworthy as its produce, a law firm that needed a site serious enough for its clients,
        pharmacy and pharmaceutical brands juggling prescriptions and inventory, and a consulting
        firm that needed its services explained clearly to people who'd never met them in person.
        Every project pushes me to solve a problem I hadn't solved before &mdash; a broken contact
        form, a login system, an admin dashboard, a database schema that actually makes sense.
      </p>

      <p class="reveal">
        I do most of my building locally with a <strong>WAMP stack</strong> before anything goes
        near a live server, which means I spend a lot of time in phpMyAdmin, dev tools, and the
        browser console chasing down the reason something isn't rendering the way it should. I'd
        call myself intermediate rather than expert &mdash; I'm still deep in the stage of learning
        where every project teaches you something you didn't know you didn't know &mdash; but I
        show up, I debug patiently, and I don't ship a site until it actually works, not just
        looks like it does.
      </p>
    </div>

  </div>
</section>

<div class="seam">
  <svg viewBox="0 0 1440 64" preserveAspectRatio="none">
    <path d="M0,26 C260,66 420,-8 700,30 C980,68 1180,4 1440,32"></path>
    <circle class="seam-dot" r="3.5" style="offset-path:path('M0,26 C260,66 420,-8 700,30 C980,68 1180,4 1440,32')"></circle>
  </svg>
</div>

<!-- ======================= HOW I WORK ======================= -->
<section class="services">
  <div class="container">
    <div class="section-head reveal">
      <div class="eyebrow">// How I work</div>
      <h2>From first message to a working site</h2>
      <p>The same rough process on every project, client or personal, big or small.</p>
    </div>

    <div class="services-grid">
      <div class="service-card reveal">
        <div class="service-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/></svg>
        </div>
        <h3>1. Understand the brief</h3>
        <p>What the business actually does, who visits the site, and what it needs to accomplish before I open an editor.</p>
      </div>

      <div class="service-card reveal">
        <div class="service-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l2.5 5 5.5.7-4 3.9 1 5.5L12 14.6 6.9 17.1l1-5.5-4-3.9L9.5 7z"/></svg>
        </div>
        <h3>2. Build it locally</h3>
        <p>Structure, styling, and PHP/MySQL logic built and tested on WAMP before anything touches a live server.</p>
      </div>

      <div class="service-card reveal">
        <div class="service-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M3 5h18v14H3zM3 9h18M8 5v4"/></svg>
        </div>
        <h3>3. Debug it properly</h3>
        <p>Forms that don't send, layouts that break on mobile, databases that don't seed right &mdash; found and fixed, not patched over.</p>
      </div>

      <div class="service-card reveal">
        <div class="service-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
        </div>
        <h3>4. Ship &amp; keep improving</h3>
        <p>Live, working, and open to feedback &mdash; most of my projects grow through several rounds after launch.</p>
      </div>
    </div>
  </div>
</section>

<div class="seam">
  <svg viewBox="0 0 1440 64" preserveAspectRatio="none">
    <path d="M0,30 C220,68 480,-8 760,32 C1020,70 1220,6 1440,26"></path>
    <circle class="seam-dot" r="3.5" style="offset-path:path('M0,30 C220,68 480,-8 760,32 C1020,70 1220,6 1440,26')"></circle>
  </svg>
</div>

<!-- ======================= CTA ======================= -->
<section class="contact">
  <div class="container" style="text-align:center;">
    <div class="eyebrow" style="justify-content:center;">// Let's build something</div>
    <h2 style="margin-bottom:18px;">Got a project in mind?</h2>
    <p style="max-width:560px; margin:0 auto 34px; color:var(--muted-400);">
      I'd like to hear about it, whether it's a brand-new site or something that needs fixing.
    </p>
    <a href="contact.php" class="btn btn-primary">Get in touch</a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
