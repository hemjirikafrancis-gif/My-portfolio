<?php
$pageTitle       = "Home";
$pageDescription = "Hemjirika's Pharmaceuticals is a Nigerian pharmaceutical company researching, manufacturing and distributing quality-assured medicines, built on rigorous science and ethical practice.";
$canonicalPath   = "/index.php";
require __DIR__ . '/includes/header.php';
?>

<main>

  <!-- ============================ HERO ============================ -->
  <section class="hero" id="hero">
    <div class="container">

      <div class="hero-copy">
        <span class="eyebrow">Monograph No. 01 — Welcome</span>
        <h1>Medicines made with <em>precision</em>,<br>delivered with care.</h1>
        <p class="lede">
          Hemjirika's Pharmaceuticals researches, manufactures and distributes
          quality-assured medicines across Nigeria — from the laboratory bench
          to the community pharmacy shelf.
        </p>
        <div class="hero-actions">
          <a href="#departments" class="btn btn-primary">
            Explore our departments <span class="arrow">&rarr;</span>
          </a>
          <a href="prescription.php" class="btn btn-accent">
            <svg class="btn-icon" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M10 3v14M3 10h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            Upload Prescription
          </a>
          <a href="#about" class="btn btn-ghost">Our story</a>
        </div>

        <div class="hero-stats">
          <div>
            <span class="stat-num">4</span>
            <span class="stat-label">Core Departments</span>
          </div>
          <div>
            <span class="stat-num">100%</span>
            <span class="stat-label">QA/QC Screened</span>
          </div>
          <div>
            <span class="stat-num">NG</span>
            <span class="stat-label">Proudly Nigerian</span>
          </div>
        </div>
      </div>

      <div class="hero-visual">
        <div class="specimen-frame">
          <span class="specimen-corner">Fig. 01 — Specimen</span>

          <!-- Slide 1: Molecular chain -->
          <div class="slide is-active">
            <svg viewBox="0 0 220 220" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Illustration of a molecular chain">
              <g class="anim-drift">
                <line x1="55" y1="70" x2="100" y2="110" stroke="#3F6B54" stroke-width="2"/>
                <line x1="100" y1="110" x2="150" y2="80" stroke="#3F6B54" stroke-width="2"/>
                <line x1="100" y1="110" x2="120" y2="160" stroke="#3F6B54" stroke-width="2"/>
                <line x1="150" y1="80" x2="170" y2="130" stroke="#3F6B54" stroke-width="2"/>
                <circle cx="55" cy="70" r="16" fill="#F4E3C1" stroke="#C68A2E" stroke-width="2"/>
                <circle cx="100" cy="110" r="20" fill="#0E1B36"/>
                <circle cx="150" cy="80" r="13" fill="#FBF8F1" stroke="#3F6B54" stroke-width="2"/>
                <circle cx="120" cy="160" r="13" fill="#F4E3C1" stroke="#C68A2E" stroke-width="2"/>
                <circle cx="170" cy="130" r="10" fill="#FBF8F1" stroke="#0E1B36" stroke-width="2"/>
              </g>
            </svg>
          </div>

          <!-- Slide 2: Lab glassware -->
          <div class="slide">
            <svg viewBox="0 0 220 220" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Illustration of laboratory glassware">
              <g class="anim-drift">
                <path d="M70 40 H100 V90 L120 170 Q121 180 110 180 H60 Q49 180 50 170 L70 90 Z" stroke="#0E1B36" stroke-width="2.4" fill="#FBF8F1"/>
                <rect x="64" y="34" width="42" height="10" rx="2" fill="#0E1B36"/>
                <path d="M58 145 H112" stroke="#C68A2E" stroke-width="2.4"/>
                <rect x="60" y="146" width="50" height="32" fill="#F4E3C1" opacity=".8"/>
                <circle class="anim-pulse" cx="84" cy="120" r="4" fill="#3F6B54"/>
                <circle class="anim-pulse" cx="96" cy="135" r="3" fill="#C68A2E"/>
                <path d="M150 70 V150 Q150 165 165 165 H175 Q190 165 190 150 V70" stroke="#3F6B54" stroke-width="2.4" fill="none"/>
                <rect x="143" y="64" width="54" height="9" rx="2" fill="#3F6B54"/>
                <rect x="153" y="125" width="34" height="35" fill="#3F6B54" opacity=".18"/>
              </g>
            </svg>
          </div>

          <!-- Slide 3: Production line -->
          <div class="slide">
            <svg viewBox="0 0 220 220" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Illustration of a pharmaceutical production line">
              <rect x="20" y="140" width="180" height="10" fill="#0E1B36"/>
              <g clip-path="url(#beltClip)">
                <g class="anim-conveyor">
                  <rect x="0" y="138" width="14" height="4" fill="#C68A2E"/>
                  <rect x="30" y="138" width="14" height="4" fill="#C68A2E"/>
                  <rect x="60" y="138" width="14" height="4" fill="#C68A2E"/>
                  <rect x="90" y="138" width="14" height="4" fill="#C68A2E"/>
                  <rect x="120" y="138" width="14" height="4" fill="#C68A2E"/>
                  <rect x="150" y="138" width="14" height="4" fill="#C68A2E"/>
                  <rect x="180" y="138" width="14" height="4" fill="#C68A2E"/>
                  <rect x="210" y="138" width="14" height="4" fill="#C68A2E"/>
                  <rect x="240" y="138" width="14" height="4" fill="#C68A2E"/>
                </g>
              </g>
              <defs><clipPath id="beltClip"><rect x="20" y="130" width="180" height="20"/></clipPath></defs>

              <!-- blister packs -->
              <g>
                <rect x="48" y="100" width="34" height="40" rx="4" fill="#FBF8F1" stroke="#0E1B36" stroke-width="2"/>
                <circle cx="58" cy="112" r="4.2" fill="#3F6B54"/>
                <circle cx="72" cy="112" r="4.2" fill="#3F6B54"/>
                <circle cx="58" cy="126" r="4.2" fill="#3F6B54"/>
                <circle cx="72" cy="126" r="4.2" fill="#3F6B54"/>

                <rect x="98" y="92" width="34" height="48" rx="4" fill="#F4E3C1" stroke="#C68A2E" stroke-width="2"/>
                <circle cx="108" cy="106" r="4.2" fill="#9C6A1E"/>
                <circle cx="122" cy="106" r="4.2" fill="#9C6A1E"/>
                <circle cx="108" cy="120" r="4.2" fill="#9C6A1E"/>
                <circle cx="122" cy="120" r="4.2" fill="#9C6A1E"/>
                <circle cx="108" cy="132" r="4.2" fill="#9C6A1E"/>
                <circle cx="122" cy="132" r="4.2" fill="#9C6A1E"/>

                <rect x="148" y="104" width="34" height="36" rx="4" fill="#FBF8F1" stroke="#0E1B36" stroke-width="2"/>
                <circle cx="158" cy="116" r="4.2" fill="#3F6B54"/>
                <circle cx="172" cy="116" r="4.2" fill="#3F6B54"/>
                <circle cx="158" cy="128" r="4.2" fill="#3F6B54"/>
                <circle cx="172" cy="128" r="4.2" fill="#3F6B54"/>
              </g>
              <!-- robotic arm -->
              <path d="M170 40 V70 H190" stroke="#0E1B36" stroke-width="3" fill="none" stroke-linecap="round"/>
              <circle cx="190" cy="70" r="5" fill="#C68A2E"/>
              <rect x="166" y="32" width="10" height="10" rx="2" fill="#0E1B36"/>
            </svg>
          </div>

          <!-- Slide 4: Real photograph -->
          <div class="slide slide-photo">
            <img src="images/img-16.jpeg" alt="A Hemjirika's Pharmaceuticals pharmacist standing among fully stocked medicine shelves" loading="lazy" width="438" height="701">
          </div>

          <span class="slide-tag">Hemjirika's — In Production</span>
          <div class="slider-dots" role="tablist" aria-label="Hero image slides">
            <button class="is-active" aria-label="Show slide 1"></button>
            <button aria-label="Show slide 2"></button>
            <button aria-label="Show slide 3"></button>
            <button aria-label="Show slide 4"></button>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- ============================ ABOUT (excerpt) ============================ -->
  <section class="section" id="about">
    <div class="container about-grid">

      <div class="about-copy" data-reveal>
        <span class="eyebrow">Monograph No. 02 — About Us</span>
        <h2>Built on the bench,<br>trusted on the shelf.</h2>
        <p>
          Hemjirika's Pharmaceuticals began with a simple conviction: that
          quality medicine shouldn't be a privilege. What started as a small
          formulation lab has grown into a full-scale pharmaceutical operation —
          one that still treats every batch with the same scrutiny as the first.
        </p>
        <p>
          Today, our team of researchers, production engineers, quality
          analysts and field representatives work across one continuous
          line: from molecule to medicine cabinet, with documentation and
          discipline at every handover.
        </p>
        <a href="about.php" class="btn btn-primary">
          Read our full story <span class="arrow">&rarr;</span>
        </a>
      </div>

      <div class="about-visual" data-reveal data-reveal-delay="120">
        <span class="specimen-corner">Fig. 02 — Foundation</span>
        <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Illustration of a mortar and pestle, symbolising pharmaceutical formulation">
          <path d="M55 110 Q55 160 100 165 Q145 160 145 110" stroke="#F4E3C1" stroke-width="3" fill="none"/>
          <path d="M50 108 H150 L138 150 Q136 160 124 162 H76 Q64 160 62 150 Z" fill="#FBF8F1" stroke="#F4E3C1" stroke-width="2.5"/>
          <ellipse cx="100" cy="108" rx="50" ry="10" fill="#C68A2E" opacity=".9"/>
          <path d="M70 60 Q95 30 132 52" stroke="#F4E3C1" stroke-width="9" stroke-linecap="round" fill="none"/>
          <circle cx="68" cy="62" r="9" fill="#F4E3C1"/>
          <circle cx="80" cy="100" r="3.4" fill="#3F6B54" class="anim-pulse"/>
          <circle cx="110" cy="98" r="3" fill="#3F6B54" class="anim-pulse"/>
          <circle cx="95" cy="104" r="2.6" fill="#C68A2E" class="anim-pulse"/>
        </svg>
        <span class="about-label">Est. on a single formulation bench</span>
      </div>

    </div>
  </section>

  <!-- ============================ DEPARTMENTS (excerpt) ============================ -->
  <section class="section section-alt" id="departments">
    <div class="container">

      <div class="section-head" data-reveal>
        <span class="eyebrow">Monograph No. 03 — Departments</span>
        <h2>One pipeline, four disciplines.</h2>
        <p class="lede">
          Every medicine we release passes through four connected stages —
          each one staffed by specialists who hand off only when their
          standard has been met.
        </p>
      </div>

      <div class="pipeline">

        <article class="dept-card" data-reveal>
          <span class="dept-stage">Stage 01</span>
          <svg class="dept-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <circle cx="20" cy="20" r="12" stroke="currentColor" stroke-width="2.4"/>
            <line x1="29" y1="29" x2="40" y2="40" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
            <path d="M14 20 h12 M20 14 v12" stroke="currentColor" stroke-width="2"/>
          </svg>
          <h3>Research &amp; Development</h3>
          <p>Where molecules are studied, formulations are tested, and tomorrow's medicines take their first form.</p>
        </article>

        <article class="dept-card" data-reveal data-reveal-delay="80">
          <span class="dept-stage">Stage 02</span>
          <svg class="dept-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <circle cx="24" cy="24" r="7" stroke="currentColor" stroke-width="2.2"/>
            <path d="M24 11v6M24 31v6M11 24h6M31 24h6M15.5 15.5l4.2 4.2M28.3 28.3l4.2 4.2M32.5 15.5l-4.2 4.2M19.7 28.3l-4.2 4.2" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
          </svg>
          <h3>Production (Manufacturing)</h3>
          <p>Validated formulas become real, physical batches — mixed, dosed and packaged at scale.</p>
        </article>

        <article class="dept-card" data-reveal data-reveal-delay="160">
          <span class="dept-stage">Stage 03</span>
          <svg class="dept-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M24 8 L38 13 V24 C38 33 31 39 24 41 C17 39 10 33 10 24 V13 Z" stroke="currentColor" stroke-width="2.2"/>
            <path d="M17 23 L22 28 L32 17" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <h3>Quality Assurance &amp; Control</h3>
          <p>Every batch is tested, traced and verified — nothing reaches the public shelf unchecked.</p>
        </article>

        <article class="dept-card" data-reveal data-reveal-delay="240">
          <span class="dept-stage">Stage 04</span>
          <svg class="dept-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M10 20 L24 14 V34 L10 28 Z" stroke="currentColor" stroke-width="2.2"/>
            <path d="M24 14 L38 10 V38 L24 34" stroke="currentColor" stroke-width="2.2"/>
            <path d="M14 28 L12 36" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
          </svg>
          <h3>Sales &amp; Marketing</h3>
          <p>The finished medicine meets pharmacies, hospitals and patients — backed by honest, evidence-led communication.</p>
        </article>

      </div>

      <div class="section-cta" data-reveal>
        <a href="departments.php" class="btn btn-primary">
          View all departments in detail <span class="arrow">&rarr;</span>
        </a>
      </div>

    </div>
  </section>

  <!-- ============================ CATEGORIES (excerpt) ============================ -->
  <section class="section" id="categories">
    <div class="container">

      <div class="section-head" data-reveal>
        <span class="eyebrow">Monograph No. 04 — Product Categories</span>
        <h2>Medicine, organised the<br>way a pharmacist thinks.</h2>
        <p class="lede">
          Our catalogue is sourced and formulated for the conditions
          Nigerian households actually face — grouped into clear categories
          so pharmacists and patients can find what they need quickly.
        </p>
      </div>

      <div class="category-grid">

        <article class="category-card" data-reveal>
          <div class="category-photo">
            <img src="images/img-17.jpeg" alt="Mortar and pestle with natural supplement ingredients" loading="lazy" width="499" height="400">
            <span class="category-tag">Category 01</span>
          </div>
          <div class="category-body">
            <h3>Vitamins &amp; Supplements</h3>
            <p>Multivitamins, haematinics and immune support formulated for everyday Nigerian diets and deficiencies.</p>
            <ul class="category-chips">
              <li>Vitamin C</li>
              <li>Folic Acid</li>
              <li>Ferrous Sulphate</li>
              <li>+more</li>
            </ul>
          </div>
        </article>

        <article class="category-card" data-reveal data-reveal-delay="100">
          <div class="category-photo">
            <img src="images/img-9.jpeg" alt="Pharmacist arranging medicine on pharmacy shelves" loading="lazy" width="700" height="438">
            <span class="category-tag">Category 02</span>
          </div>
          <div class="category-body">
            <h3>Malaria &amp; Fever</h3>
            <p>Fast-acting antimalarials and antipyretics, stocked for the conditions our climate makes most common.</p>
            <ul class="category-chips">
              <li>Artemether-Lumefantrine</li>
              <li>Paracetamol</li>
              <li>Artesunate</li>
              <li>+more</li>
            </ul>
          </div>
        </article>

        <article class="category-card" data-reveal data-reveal-delay="200">
          <div class="category-photo">
            <img src="images/img-7.jpeg" alt="Hands holding a selection of medicine boxes" loading="lazy" width="643" height="476">
            <span class="category-tag">Category 03</span>
          </div>
          <div class="category-body">
            <h3>Antibiotics &amp; Chronic Care</h3>
            <p>Infection treatment and long-term management formulations for hypertension, diabetes and related conditions.</p>
            <ul class="category-chips">
              <li>Amoxicillin</li>
              <li>Metformin</li>
              <li>Amlodipine</li>
              <li>+more</li>
            </ul>
          </div>
        </article>

      </div>

      <div class="section-cta" data-reveal>
        <a href="categories.php" class="btn btn-primary">
          View all categories &amp; products <span class="arrow">&rarr;</span>
        </a>
      </div>

    </div>
  </section>

  <!-- ============================ COMPLIANCE (excerpt) ============================ -->
  <section class="section section-alt" id="compliance">
    <div class="container compliance-teaser-grid">

      <div class="compliance-teaser-copy" data-reveal>
        <span class="eyebrow">Monograph No. 05 — Regulatory Compliance</span>
        <h2>Verified at every<br>regulatory checkpoint.</h2>
        <p>
          Every product carrying the Hemjirika's name is registered and
          screened against the standards Nigerian and international
          regulators require — from raw material sourcing through to the
          finished pack.
        </p>
        <p>
          We work within the frameworks set by NAFDAC, the Pharmacists
          Council of Nigeria, and WHO Good Manufacturing Practice
          guidelines, with documentation kept ready for inspection at
          every stage of production.
        </p>
        <a href="compliance.php" class="btn btn-primary">
          View our regulatory compliance <span class="arrow">&rarr;</span>
        </a>
      </div>

      <div class="compliance-teaser-visual" data-reveal data-reveal-delay="120">
        <div class="compliance-photo-stack">
          <img src="images/img-20.jpeg" alt="Pharmacist reviewing compliance data on a tablet inside the pharmacy" loading="lazy" width="678" height="452">
        </div>
        <div class="compliance-teaser-cert">
          <img src="images/img-cert-1.jpg" alt="A sample regulatory certificate on file" loading="lazy" width="168" height="120">
          <span>Registration &amp; audit documentation kept current and on file.</span>
        </div>
      </div>

    </div>
  </section>


  <!-- ============================ JOURNAL (mini blog) ============================ -->
  <section class="section journal-mini" id="journal">
    <div class="container">
      <div class="section-head journal-mini-head" data-reveal>
        <span class="eyebrow">Monograph No. 07 — The Journal</span>
        <h2>From the bench, the line<br>and the pharmacy floor.</h2>
        <p class="lede">Essays on quality-assured medicines, regulatory science and pharmacy practice in Nigeria.</p>
      </div>

      <div class="blog-grid blog-grid-mini">
        <article class="blog-card" data-reveal>
          <a href="blog-post.php?slug=science-behind-quality-assured-medicines" class="blog-card-media">
            <img src="images/img-10.jpeg" alt="Laboratory quality assurance" loading="lazy">
            <span class="blog-tag">Research</span>
          </a>
          <div class="blog-card-body">
            <div class="blog-meta"><span>March 12, 2026</span><span aria-hidden="true">·</span><span>6 min read</span></div>
            <h3><a href="blog-post.php?slug=science-behind-quality-assured-medicines">The Science Behind Quality-Assured Medicines</a></h3>
            <p>How rigorous QA/QC protocols and analytical chemistry come together to make a tablet you can trust.</p>
            <a href="blog-post.php?slug=science-behind-quality-assured-medicines" class="blog-readmore">Continue reading <span class="arrow">&rarr;</span></a>
          </div>
        </article>

        <article class="blog-card" data-reveal data-reveal-delay="80">
          <a href="blog-post.php?slug=manufacturing-medicine-in-nigeria" class="blog-card-media">
            <img src="images/img-12.jpeg" alt="Local pharmaceutical manufacturing" loading="lazy">
            <span class="blog-tag">Production</span>
          </a>
          <div class="blog-card-body">
            <div class="blog-meta"><span>February 24, 2026</span><span aria-hidden="true">·</span><span>8 min read</span></div>
            <h3><a href="blog-post.php?slug=manufacturing-medicine-in-nigeria">Manufacturing Medicine in Nigeria: A New Chapter</a></h3>
            <p>Local production is not just an economic story — it is a resilience story reshaping healthcare access.</p>
            <a href="blog-post.php?slug=manufacturing-medicine-in-nigeria" class="blog-readmore">Continue reading <span class="arrow">&rarr;</span></a>
          </div>
        </article>

        <article class="blog-card" data-reveal data-reveal-delay="160">
          <a href="blog-post.php?slug=understanding-nafdac-compliance" class="blog-card-media">
            <img src="images/img-cert-2.jpg" alt="NAFDAC regulatory compliance" loading="lazy">
            <span class="blog-tag">Regulatory</span>
          </a>
          <div class="blog-card-body">
            <div class="blog-meta"><span>February 08, 2026</span><span aria-hidden="true">·</span><span>5 min read</span></div>
            <h3><a href="blog-post.php?slug=understanding-nafdac-compliance">Understanding NAFDAC Compliance, End to End</a></h3>
            <p>A plain-language tour of the checkpoints every medicine must pass — from raw material to finished pack.</p>
            <a href="blog-post.php?slug=understanding-nafdac-compliance" class="blog-readmore">Continue reading <span class="arrow">&rarr;</span></a>
          </div>
        </article>
      </div>

      <div class="section-cta journal-mini-cta" data-reveal>
        <a href="blog.php" class="btn btn-prestige">
          <span>Visit the Journal</span>
          <span class="btn-prestige-arrow" aria-hidden="true">&rarr;</span>
        </a>
      </div>
    </div>
  </section>

  <!-- ============================ CONTACT ============================ -->
  <section class="contact" id="contact">
    <div class="container contact-grid">

      <div class="contact-copy" data-reveal>
        <span class="eyebrow">Monograph No. 06 — Contact</span>
        <h2>Let's talk medicine,<br>partnerships or careers.</h2>
        <p class="lede">
          Whether you're a distributor, a healthcare professional, or
          considering a role on our team — we'd like to hear from you.
        </p>
        <dl class="contact-details">
          <div>
            <dt>Head Office</dt>
            <dd>Kano, Kano State, Nigeria</dd>
          </div>
          <div>
            <dt>Email</dt>
            <dd>info@hemjirikas.com</dd>
          </div>
          <div>
            <dt>Phone</dt>
            <dd>+234 (0) 000 000 0000</dd>
          </div>
        </dl>
      </div>

      <form class="contact-form" id="contact-form" data-reveal data-reveal-delay="100" action="mail-handler.php" method="POST">
        <div class="form-field">
          <label for="name">Full name</label>
          <input type="text" id="name" name="name" placeholder="Your name" required>
        </div>
        <div class="form-field">
          <label for="email">Email address</label>
          <input type="email" id="email" name="email" placeholder="you@example.com" required>
        </div>
        <div class="form-field">
          <label for="message">Message</label>
          <textarea id="message" name="message" rows="4" placeholder="How can we help?" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send message <span class="arrow">&rarr;</span></button>
        <p class="form-feedback" style="margin-top:14px; font-size:.85rem; color:#F4E3C1;"></p>
      </form>

    </div>
  </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
