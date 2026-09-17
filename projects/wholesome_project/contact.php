<?php $page='contact'; $pageTitle='Contact – Wholesome Legal House'; include 'includes/header.php';
$ph_title='Contact <em>Us</em>'; $ph_sub='Get in Touch'; $ph_crumb='Contact'; $ph_image='Images/img-12.jpg';
include 'includes/page-hero.php'; ?>

<section class="contact-section">
  <div class="container">
    <div class="section-header">
      <span class="section-label light">Contact Us</span>
      <h2>Get in Touch</h2>
      <p>Book a free consultation or reach us through any of the channels below.</p>
    </div>
    <div class="contact-grid">
      <div class="contact-info">
        <div class="contact-item">
          <div class="contact-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
          <div><strong>Location</strong><p>Kilometre 1 Plaza Between Babban Gwari Roundabout and, Airport Rd, Fagge 700271, Kano</p></div>
        </div>
        <div class="contact-item">
          <div class="contact-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,12 2,6"/></svg></div>
          <div><strong>Email</strong><p>Office@wholesomelegal.com</p></div>
        </div>
        <div class="contact-item">
          <div class="contact-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.22 1.18 2 2 0 012.22 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.09a16 16 0 006 6l.56-.56a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92v2z"/></svg></div>
          <div><strong>Phone</strong><p>+234 805 517 3900</p></div>
        </div>
      </div>

      <div class="contact-form-wrap">
        <h3>Send Us a Message</h3>
        <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
          <div class="alert alert-success">✅ Message sent successfully!</div>
        <?php elseif (isset($_GET['status']) && $_GET['status'] === 'error'): ?>
          <div class="alert alert-error">⚠️ Please correct the errors and try again.</div>
        <?php endif; ?>

        <form class="contact-form" id="contactForm" action="submit.php" method="POST" autocomplete="off">
          <div class="form-row">
            <input type="text" name="full_name" placeholder="Your Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
          </div>
          <input type="text" name="subject" placeholder="Subject" required>
          <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
          <button type="submit" class="btn-primary">Send Message</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
