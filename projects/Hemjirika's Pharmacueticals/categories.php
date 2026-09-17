<?php
$pageTitle       = "Product Categories";
$pageDescription = "Browse Hemjirika's Pharmaceuticals product categories — Vitamins & Supplements, Malaria & Fever, and Antibiotics & Chronic Care — sourced and formulated for Nigerian households.";
$canonicalPath   = "/categories.php";
require __DIR__ . '/includes/header.php';
?>

<main>

  <section class="page-hero">
    <div class="container page-hero-grid">
      <div>
        <p class="breadcrumb"><a href="index.php">Home</a> / Categories</p>
        <span class="eyebrow">Monograph No. 04 — Full Record</span>
        <h1>Three categories, one shared standard.</h1>
        <p class="lede">
          Every product below is grouped by the condition it treats, not
          just its chemical family — the way our pharmacists actually
          think when a customer walks in.
        </p>
      </div>
      <div class="page-hero-photo" data-reveal>
        <span class="specimen-corner">Fig. 04 — Catalogue</span>
        <img src="images/img-12.jpeg" alt="A Hemjirika's Pharmaceuticals pharmacist reviewing stock on a tablet among shelved products" loading="lazy" width="480" height="640">
      </div>
    </div>
  </section>

  <nav class="category-nav" aria-label="Jump to category">
    <a href="#vitamins-supplements">Vitamins &amp; Supplements</a>
    <a href="#malaria-fever">Malaria &amp; Fever</a>
    <a href="#antibiotics-chronic-care">Antibiotics &amp; Chronic Care</a>
  </nav>

  <section class="section">
    <div class="container">

      <div class="compliance-note">
        The products listed on this page are shown by generic (INN) name to
        illustrate the categories we stock. <em>Replace this listing with
        your verified, current in-stock catalogue and NAFDAC registration
        numbers before publishing.</em> Antibiotics and several chronic-care
        medicines require a valid prescription — our pharmacists will always
        confirm this before dispensing.
      </div>

      <div class="category-detail">

        <!-- 1. Vitamins & Supplements -->
        <article class="category-block" id="vitamins-supplements">
          <div class="category-block-photo" data-reveal>
            <div class="category-block-photo-main">
              <img src="images/img-17.jpeg" alt="Mortar and pestle surrounded by natural supplement ingredients" loading="lazy" width="499" height="400">
            </div>
            <div class="category-block-photo-secondary">
              <img src="images/img-4.jpg" alt="Shelves of vitamin and supplement packaging" loading="lazy" width="612" height="426">
            </div>
          </div>
          <div data-reveal data-reveal-delay="100">
            <span class="dept-stage">Category 01</span>
            <h2 style="margin: var(--sp-3) 0 var(--sp-4);">Vitamins &amp; Supplements</h2>
            <p>
              Everyday support for diet gaps, low iron and general immunity —
              formulated for the nutritional patterns most common across
              Nigerian households, from growing children to expectant mothers.
            </p>
            <div class="drug-table">
              <div class="drug-row">
                <div><h4>Vitamin C (Ascorbic Acid)</h4><p>Daily antioxidant and immune-support supplement.</p></div>
                <span class="drug-form">Tablet</span>
              </div>
              <div class="drug-row">
                <div><h4>Folic Acid</h4><p>Supports healthy red blood cell formation; routinely recommended in pregnancy.</p></div>
                <span class="drug-form">Tablet</span>
              </div>
              <div class="drug-row">
                <div><h4>Ferrous Sulphate + Folic Acid</h4><p>Combined haematinic for anaemia prevention and management.</p></div>
                <span class="drug-form">Tablet</span>
              </div>
              <div class="drug-row">
                <div><h4>Vitamin B-Complex</h4><p>Supports energy metabolism and healthy nerve function.</p></div>
                <span class="drug-form">Syrup</span>
              </div>
              <div class="drug-row">
                <div><h4>Multivitamin Syrup</h4><p>General multivitamin and mineral top-up for children and adults.</p></div>
                <span class="drug-form">Syrup</span>
              </div>
              <div class="drug-row">
                <div><h4>Zinc + Vitamin C Effervescent</h4><p>Fast-dissolving formula for extra immune support.</p></div>
                <span class="drug-form">Effervescent</span>
              </div>
            </div>
          </div>
        </article>

        <!-- 2. Malaria & Fever -->
        <article class="category-block" id="malaria-fever">
          <div class="category-block-photo" data-reveal>
            <div class="category-block-photo-main">
              <img src="images/img-9.jpeg" alt="Pharmacist arranging medicine boxes on a fully stocked shelf" loading="lazy" width="700" height="438">
            </div>
            <div class="category-block-photo-secondary">
              <img src="images/img-15.jpeg" alt="Pharmacist selecting fever and malaria medication from a shelf" loading="lazy" width="541" height="567">
            </div>
          </div>
          <div data-reveal data-reveal-delay="100">
            <span class="dept-stage">Category 02</span>
            <h2 style="margin: var(--sp-3) 0 var(--sp-4);">Malaria &amp; Fever</h2>
            <p>
              Fast-acting antimalarials and antipyretics, kept in steady
              supply for the conditions our climate and mosquito season
              make a recurring reality for most Nigerian families.
            </p>
            <div class="drug-table">
              <div class="drug-row">
                <div><h4>Artemether-Lumefantrine</h4><p>First-line combination therapy for uncomplicated malaria.</p></div>
                <span class="drug-form">Tablet</span>
              </div>
              <div class="drug-row">
                <div><h4>Artesunate Injection</h4><p>Fast-acting treatment for severe malaria under clinical supervision.</p></div>
                <span class="drug-form">Injection</span>
              </div>
              <div class="drug-row">
                <div><h4>Artesunate-Amodiaquine</h4><p>Alternative artemisinin-based combination therapy.</p></div>
                <span class="drug-form">Tablet</span>
              </div>
              <div class="drug-row">
                <div><h4>Sulfadoxine-Pyrimethamine</h4><p>Used for intermittent preventive treatment of malaria in pregnancy.</p></div>
                <span class="drug-form">Tablet</span>
              </div>
              <div class="drug-row">
                <div><h4>Paracetamol</h4><p>Fever and pain relief, dosed safely across most age groups.</p></div>
                <span class="drug-form">Tablet / Syrup</span>
              </div>
              <div class="drug-row">
                <div><h4>Ibuprofen</h4><p>Anti-inflammatory option for fever and associated pain.</p></div>
                <span class="drug-form">Tablet / Syrup</span>
              </div>
            </div>
          </div>
        </article>

        <!-- 3. Antibiotics & Chronic Care -->
        <article class="category-block" id="antibiotics-chronic-care">
          <div class="category-block-photo" data-reveal>
            <div class="category-block-photo-main">
              <img src="images/img-7.jpeg" alt="Hands holding a selection of antibiotic and chronic-care medicine boxes" loading="lazy" width="643" height="476">
            </div>
            <div class="category-block-photo-secondary">
              <img src="images/img-19.jpeg" alt="Two pharmacists reviewing a patient's chronic-care treatment record" loading="lazy" width="335" height="597">
            </div>
          </div>
          <div data-reveal data-reveal-delay="100">
            <span class="dept-stage">Category 03</span>
            <h2 style="margin: var(--sp-3) 0 var(--sp-4);">Antibiotics &amp; Chronic Care</h2>
            <p>
              Infection treatment alongside long-term management for
              hypertension, diabetes and related conditions — dispensed
              with the follow-up and dosage guidance ongoing care requires.
            </p>
            <div class="drug-table">
              <div class="drug-row">
                <div><h4>Amoxicillin</h4><p>Broad-spectrum antibiotic for common bacterial infections.</p></div>
                <span class="drug-form">Capsule / Syrup</span>
              </div>
              <div class="drug-row">
                <div><h4>Amoxicillin-Clavulanate</h4><p>Extended-spectrum antibiotic for more resistant infections.</p></div>
                <span class="drug-form">Tablet</span>
              </div>
              <div class="drug-row">
                <div><h4>Ciprofloxacin</h4><p>Fluoroquinolone antibiotic for urinary and gastrointestinal infections.</p></div>
                <span class="drug-form">Tablet</span>
              </div>
              <div class="drug-row">
                <div><h4>Metronidazole</h4><p>Treats anaerobic bacterial and certain parasitic infections.</p></div>
                <span class="drug-form">Tablet</span>
              </div>
              <div class="drug-row">
                <div><h4>Metformin</h4><p>First-line oral therapy for type 2 diabetes management.</p></div>
                <span class="drug-form">Tablet</span>
              </div>
              <div class="drug-row">
                <div><h4>Amlodipine</h4><p>Calcium-channel blocker for long-term blood pressure control.</p></div>
                <span class="drug-form">Tablet</span>
              </div>
              <div class="drug-row">
                <div><h4>Atorvastatin</h4><p>Statin for cholesterol management as part of chronic cardiovascular care.</p></div>
                <span class="drug-form">Tablet</span>
              </div>
            </div>
          </div>
        </article>

      </div>

      <div class="section-cta" style="margin-top: var(--sp-8);" data-reveal>
        <a href="prescription.php" class="btn btn-accent" style="display:inline-flex;">
          <svg class="btn-icon" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M10 3v14M3 10h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
          Have a prescription? Upload it here
        </a>
      </div>

    </div>
  </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
