<?php
$pageTitle       = "Departments — Research, Production, QA/QC &amp; Sales";
$pageDescription = "A full look at the four departments behind every Hemjirika's Pharmaceuticals product: Research &amp; Development, Production, Quality Assurance &amp; Quality Control, and Sales &amp; Marketing.";
$canonicalPath   = "/departments.php";
require __DIR__ . '/includes/header.php';
?>

<main>

  <section class="page-hero">
    <div class="container">
      <p class="breadcrumb"><a href="index.php">Home</a> / Departments</p>
      <span class="eyebrow">Monograph No. 03 — Full Record</span>
      <h1>Four stages. One standard.</h1>
      <p class="lede">Every product that carries our name moves through these
        four departments, in this order. None is allowed to skip the one
        before it.</p>
    </div>
  </section>

  <section class="section">
    <div class="container">

      <div class="dept-detail">

        <!-- 1. R&D -->
        <article class="dept-detail-row" id="rnd" data-reveal data-reveal-delay="0">
          <div>
            <svg class="dept-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <circle cx="20" cy="20" r="12" stroke="currentColor" stroke-width="2.4"/>
              <line x1="29" y1="29" x2="40" y2="40" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
              <path d="M14 20 h12 M20 14 v12" stroke="currentColor" stroke-width="2"/>
            </svg>
            <p class="dept-marker">Stage 01</p>
            <h2 style="margin-top:6px;">Research &amp; Development</h2>
          </div>
          <div>
            <p>
              This is where every product begins — long before it has a
              name, a box, or a price. R&amp;D studies active compounds,
              models how they behave in the body, and builds the first
              working formulations in controlled, small-batch conditions.
            </p>
            <p>The department is responsible for:</p>
            <ul>
              <li>Identifying and evaluating candidate compounds and formulations</li>
              <li>Running bench-scale trials and stability studies</li>
              <li>Documenting findings against recognised pharmacopeial standards</li>
              <li>Handing off a fully specified, repeatable formula — not a one-off success</li>
            </ul>
          </div>
        </article>

        <!-- 2. Production -->
        <article class="dept-detail-row" id="production" data-reveal data-reveal-delay="80">
          <div>
            <svg class="dept-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <circle cx="24" cy="24" r="7" stroke="currentColor" stroke-width="2.2"/>
              <path d="M24 11v6M24 31v6M11 24h6M31 24h6M15.5 15.5l4.2 4.2M28.3 28.3l4.2 4.2M32.5 15.5l-4.2 4.2M19.7 28.3l-4.2 4.2" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
            </svg>
            <p class="dept-marker">Stage 02</p>
            <h2 style="margin-top:6px;">Production (Manufacturing)</h2>
          </div>
          <div>
            <p>
              Production takes the formula R&amp;D validated and turns it
              into physical stock — at the volume the market actually
              needs. This is a precise, repeatable process, not a scaled-up
              guess; every input is measured against the original
              specification.
            </p>
            <p>The department is responsible for:</p>
            <ul>
              <li>Sourcing and verifying raw materials against specification</li>
              <li>Mixing, dosing, and forming tablets, capsules, syrups or other formats</li>
              <li>Packaging into blister packs, bottles and cartons under hygienic conditions</li>
              <li>Logging batch numbers and production data for full traceability</li>
            </ul>
          </div>
        </article>

        <!-- 3. QA/QC -->
        <article class="dept-detail-row" id="qaqc" data-reveal data-reveal-delay="160">
          <div>
            <svg class="dept-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M24 8 L38 13 V24 C38 33 31 39 24 41 C17 39 10 33 10 24 V13 Z" stroke="currentColor" stroke-width="2.2"/>
              <path d="M17 23 L22 28 L32 17" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <p class="dept-marker">Stage 03</p>
            <h2 style="margin-top:6px;">Quality Assurance &amp; Quality Control (QA/QC)</h2>
          </div>
          <div>
            <p>
              QA/QC is the department with veto power. Quality Assurance
              audits the process itself — checking that procedures were
              followed correctly from start to finish. Quality Control
              tests the physical output — checking that the actual tablet,
              capsule or syrup meets specification before it's released.
            </p>
            <p>The department is responsible for:</p>
            <ul>
              <li>Auditing production records against standard operating procedures</li>
              <li>Laboratory testing of samples from every batch for potency, purity and consistency</li>
              <li>Holding or rejecting any batch that fails to meet specification</li>
              <li>Maintaining the documentation trail required for regulatory compliance</li>
            </ul>
          </div>
        </article>

        <!-- 4. Sales & Marketing -->
        <article class="dept-detail-row" id="sales-marketing" data-reveal data-reveal-delay="240">
          <div>
            <svg class="dept-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M10 20 L24 14 V34 L10 28 Z" stroke="currentColor" stroke-width="2.2"/>
              <path d="M24 14 L38 10 V38 L24 34" stroke="currentColor" stroke-width="2.2"/>
              <path d="M14 28 L12 36" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
            </svg>
            <p class="dept-marker">Stage 04</p>
            <h2 style="margin-top:6px;">Sales &amp; Marketing</h2>
          </div>
          <div>
            <p>
              Once a batch clears QA/QC, it's this department's job to get
              it into the right hands — pharmacies, hospitals, distributors
              and, ultimately, patients — and to explain, accurately, what
              it does.
            </p>
            <p>The department is responsible for:</p>
            <ul>
              <li>Building and maintaining relationships with pharmacies, clinics and distributors</li>
              <li>Producing accurate product information and packaging copy</li>
              <li>Managing pricing strategy alongside affordability commitments</li>
              <li>Collecting field and market feedback and routing it back to R&amp;D</li>
            </ul>
          </div>
        </article>

      </div>

      <div class="section-cta" style="margin-top: var(--sp-8);">
        <a href="about.php" class="btn btn-primary">
          Read our mission, vision &amp; ethics <span class="arrow">&rarr;</span>
        </a>
      </div>

    </div>
  </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
