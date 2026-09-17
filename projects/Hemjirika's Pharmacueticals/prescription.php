<?php
$pageTitle       = "Upload Prescription";
$pageDescription = "Upload your prescription to Hemjirika's Pharmaceuticals and our pharmacists will confirm availability, pricing and delivery or pickup.";
$canonicalPath   = "/prescription.php";
require __DIR__ . '/includes/header.php';

$rxStatus  = $_GET['rx'] ?? null;
$rxMessage = isset($_GET['msg']) ? htmlspecialchars((string)$_GET['msg']) : '';
?>

<main>

  <section class="page-hero">
    <div class="container page-hero-grid">
      <div>
        <p class="breadcrumb"><a href="index.php">Home</a> / Upload Prescription</p>
        <span class="eyebrow">Monograph No. 06 — Prescription Upload</span>
        <h1>Skip the queue.<br>Upload your prescription.</h1>
        <p class="lede">
          Send us a clear photo or scan of your prescription and a
          registered pharmacist will confirm availability, pricing, and
          your fastest option for pickup or delivery — usually within
          one working day.
        </p>
      </div>
      <div class="page-hero-photo" data-reveal>
        <span class="specimen-corner">Fig. 06 — Upload</span>
        <img src="images/img-18.jpeg" alt="Hands typing on a laptop next to medicine bottles, representing an online prescription upload" loading="lazy" width="600" height="300">
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">

      <div class="rx-layout">

        <div data-reveal>
          <span class="eyebrow">How it works</span>
          <h2 style="margin: var(--sp-4) 0 0;">Three steps, one pharmacist review.</h2>

          <div class="rx-steps">
            <div class="rx-step">
              <span class="rx-step-num">1</span>
              <div>
                <h4>Fill in your details</h4>
                <p>Tell us who the prescription is for, and how to reach you — phone number preferred for a fast confirmation call.</p>
              </div>
            </div>
            <div class="rx-step">
              <span class="rx-step-num">2</span>
              <div>
                <h4>Upload a clear photo or scan</h4>
                <p>A well-lit photo, PDF or scan works — as long as the drug names, dosage and doctor's signature are legible.</p>
              </div>
            </div>
            <div class="rx-step">
              <span class="rx-step-num">3</span>
              <div>
                <h4>We confirm, you receive</h4>
                <p>A registered pharmacist checks stock and pricing, then calls or emails you to confirm pickup at our counter or delivery to your address.</p>
              </div>
            </div>
          </div>

          <div class="rx-trust">
            <div class="rx-trust-photo">
              <img src="images/img-6.jpg" alt="A Hemjirika's Pharmaceuticals pharmacist consulting with a customer at the counter" loading="lazy" width="120" height="120">
            </div>
            <p><strong>Reviewed by registered pharmacists</strong> — every upload is checked by a qualified professional before anything is prepared or dispensed. Nothing is auto-fulfilled.</p>
          </div>

          <div class="photo-frame" style="aspect-ratio:16/10;">
            <img src="images/img-10.jpeg" alt="A hand holding a pill bottle beside a blister pack of medicine on a table" loading="lazy" width="678" height="452">
          </div>
        </div>

        <div class="rx-panel" data-reveal data-reveal-delay="120">
          <div class="container-inner">
            <span class="eyebrow">Secure Upload</span>
            <h2>Prescription details</h2>
            <p>Fields marked * are required. Your information is used only to fulfil this order and is never shared with third parties.</p>

            <form id="rx-form" action="prescription-upload-handler.php" method="POST" enctype="multipart/form-data" novalidate>

              <div class="rx-grid-fields">
                <div class="form-field">
                  <label for="rx-name">Full name *</label>
                  <input type="text" id="rx-name" name="patient_name" placeholder="Patient's full name" required>
                </div>
                <div class="form-field">
                  <label for="rx-phone">Phone number *</label>
                  <input type="tel" id="rx-phone" name="phone" placeholder="e.g. 0803 000 0000" required>
                </div>
              </div>

              <div class="rx-grid-fields">
                <div class="form-field">
                  <label for="rx-email">Email address</label>
                  <input type="email" id="rx-email" name="email" placeholder="you@example.com">
                </div>
                <div class="form-field">
                  <label for="rx-fulfilment">Preferred fulfilment</label>
                  <select id="rx-fulfilment" name="fulfilment" style="width:100%; background: rgba(247,244,237,.06); border:1px solid rgba(247,244,237,.25); border-radius: var(--radius); padding:12px 14px; color: var(--paper); font-family: var(--font-body); font-size:.95rem;">
                    <option value="pickup">Pickup in-store</option>
                    <option value="delivery">Delivery</option>
                  </select>
                </div>
              </div>

              <div class="form-field">
                <label for="rx-address">Delivery address (if applicable)</label>
                <input type="text" id="rx-address" name="address" placeholder="Street, city, state">
              </div>

              <div class="form-field">
                <label>Upload prescription *</label>
                <div class="rx-dropzone" id="rx-dropzone">
                  <input type="file" id="rx-file" name="prescription_file" accept=".jpg,.jpeg,.png,.pdf" required>
                  <svg class="rx-dropzone-icon" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M20 6 V26 M20 6 L12 14 M20 6 L28 14" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 28 V32 Q6 34 8 34 H32 Q34 34 34 32 V28" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                  </svg>
                  <p class="rx-dropzone-text"><strong>Click to upload</strong> or drag a file here — JPG, PNG or PDF, up to 8MB.</p>
                  <div class="rx-filelist" id="rx-filelist"></div>
                </div>
              </div>

              <div class="form-field">
                <label for="rx-notes">Additional notes</label>
                <textarea id="rx-notes" name="notes" rows="3" placeholder="Anything our pharmacist should know — allergies, urgency, substitutions you're open to..."></textarea>
              </div>

              <button type="submit" class="btn btn-accent">
                <svg class="btn-icon" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M10 3v14M3 10h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                Submit prescription
              </button>
              <p class="rx-form-feedback<?php echo $rxStatus ? ' is-visible is-' . htmlspecialchars($rxStatus) : ''; ?>" id="rx-feedback"><?php echo $rxMessage; ?></p>
            </form>
          </div>
        </div>

      </div>

    </div>
  </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
