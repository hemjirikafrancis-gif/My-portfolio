
<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['errors'], $_SESSION['old']);
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us – GreenCross Pharmacy</title>
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


</head>
<body>

<header>
  <div class="navbar">
    <div class="logo"><img src="images/logo.png" alt="GreenCross Pharmacy Logo"></div>
    <button class="hamburger" id="hamburger"><span></span><span></span><span></span></button>
    <ul class="nav-links" id="navLinks">
      <li><a href="index.html">Home</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="services.html">Services</a></li>
      <li><a href="products.html">Products</a></li>
      <li><a href="blog.html">Blog</a></li>
      <li><a href="contact.html" class="active nav-cta">Contact Us</a></li>
    </ul>
  </div>
</header>

<section class="banner">
  <div class="banner-content">
    <h1>Contact Us</h1>
    <div class="breadcrumb"><a href="index.html">Home</a><span>›</span>Contact</div>
  </div>
</section>

<section class="section">
  <div class="contact-layout">
    <!-- LEFT: Contact Info -->
    <div class="contact-info">
      <div class="label" style="display:inline-block;background:#e8f5ee;color:#1b8f4d;font-size:13px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;padding:6px 18px;border-radius:30px;margin-bottom:14px;">Reach Us</div>
      <h2>We're Here to <span>Help You</span></h2>
      <p>Whether you have a question about a medicine, want to place an order, or need professional healthcare advice, our team is ready and waiting. Reach out to us through any of the channels below.</p>

      <div class="info-items">
        <div class="info-item">
          <div class="info-icon">📍</div>
          <div>
            <strong>Our Location</strong>
            <p>No. 14 Healthcare Avenue, Wuse Zone 3, Abuja, FCT, Nigeria</p>
          </div>
        </div>
        <div class="info-item">
          <div class="info-icon">📞</div>
          <div>
            <strong>Phone Numbers</strong>
            <p>+234 800 123 4567 (Main Line)<br>+234 800 765 4321 (WhatsApp Orders)</p>
          </div>
        </div>
        <div class="info-item">
          <div class="info-icon">✉️</div>
          <div>
            <strong>Email Address</strong>
            <p>info@greencrosspharmacy.com<br>orders@greencrosspharmacy.com</p>
          </div>
        </div>
        <div class="info-item">
          <div class="info-icon">🕒</div>
          <div>
            <strong>Opening Hours</strong>
            <p>
              Monday – Friday: 8:00 AM – 8:00 PM<br>
              Saturday: 9:00 AM – 6:00 PM<br>
              Sunday: Emergency line only<br>
              Public Holidays: 10:00 AM – 4:00 PM
            </p>
          </div>
        </div>
      </div>

      <h3 style="font-size:16px;font-weight:600;margin-bottom:14px;color:#1a1a2e;">Follow Us Online</h3>
      <div class="social-row">
        <a href="#" class="social-link" title="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social-link" title="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social-link" title="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" class="social-link" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>

    <!-- RIGHT: Contact Form -->
    <div class="contact-form-wrap">
      <h3>Send Us a Message</h3>
      <?php if (isset($_GET['status']) && $_GET['status'] === 'success') : ?>
    <div class="success-message">
        ✅ Message sent successfully!
    </div>
<?php endif; ?>
    
      <div id="form-success" style="display:none;text-align:center;padding:40px 20px;">
        <div style="font-size:52px;margin-bottom:16px;">✅</div>  
      </div>
      <form 
      id="contactForm"
      class="contact-form"
      action="submit.php"
      method="POST"
      autocomplete="off">

  <div class="form-row">

    <input type="text"
           name="first_name"
           placeholder="First Name"
           required>

    <input type="text"
           name="last_name"
           placeholder="Last Name"
           required>

  </div>

  <input type="email"
         name="email"
         placeholder="Email Address"
         required>

  <input type="tel"
         name="phone"
         placeholder="Phone Number">

  <select name="subject" required>

    <option value="" disabled selected>
      Subject / Reason for Contact
    </option>

    <option>Medicine Order Enquiry</option>
    <option>Prescription Submission</option>
    <option>Delivery Information</option>
    <option>Product Availability</option>
    <option>Corporate / Bulk Order</option>
    <option>Healthcare Consultation</option>
    <option>General Enquiry</option>

  </select>

  <textarea name="message"
            rows="5"
            placeholder="Write your message here..."
            required></textarea>

  <button type="submit" class="btn">
    Send Message
  </button>

</form>
    </div>
  </div>

  <!-- MAP PLACEHOLDER -->
  <div class="map-wrap" style="margin-top:60px;">
    <div style="text-align:center;">
      <i class="fas fa-map-marker-alt" style="font-size:36px;margin-bottom:12px;display:block;"></i>
      <strong style="font-size:17px;display:block;margin-bottom:6px;">GreenCross Pharmacy</strong>
      <span>No. 14 Healthcare Avenue, Wuse Zone 3, Abuja — <a href="https://maps.google.com" target="_blank" style="color:#1b8f4d;font-weight:600;text-decoration:underline;">Open in Google Maps</a></span>
    </div>
  </div>
</section>

<!-- QUICK CONTACT BOXES -->
<section class="section-full" style="background:#f9fafb;padding:70px 7%;">
  <div style="max-width:1400px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:24px;">
    <div style="background:white;border-radius:16px;padding:30px;text-align:center;box-shadow:0 4px 24px rgba(0,0,0,0.08);border:1px solid #e0e0e0;">
      <div style="font-size:36px;margin-bottom:14px;">📱</div>
      <h3 style="font-size:17px;font-weight:600;margin-bottom:8px;">WhatsApp Order</h3>
      <p style="font-size:14px;color:#555;margin-bottom:16px;">Send your prescription or product list via WhatsApp for fast processing.</p>
      <a href="#" class="btn" style="font-size:14px;padding:10px 22px;">Message Us</a>
    </div>
    <div style="background:white;border-radius:16px;padding:30px;text-align:center;box-shadow:0 4px 24px rgba(0,0,0,0.08);border:1px solid #e0e0e0;">
      <div style="font-size:36px;margin-bottom:14px;">🚀</div>
      <h3 style="font-size:17px;font-weight:600;margin-bottom:8px;">Request Delivery</h3>
      <p style="font-size:14px;color:#555;margin-bottom:16px;">Need medicines delivered? Call us now and we'll dispatch within the hour.</p>
      <a href="tel:+2348001234567" class="btn" style="font-size:14px;padding:10px 22px;">Call Now</a>
    </div>
    <div style="background:white;border-radius:16px;padding:30px;text-align:center;box-shadow:0 4px 24px rgba(0,0,0,0.08);border:1px solid #e0e0e0;">
      <div style="font-size:36px;margin-bottom:14px;">🏢</div>
      <h3 style="font-size:17px;font-weight:600;margin-bottom:8px;">Corporate Orders</h3>
      <p style="font-size:14px;color:#555;margin-bottom:16px;">Bulk orders for businesses, clinics, NGOs, and government institutions.</p>
      <a href="mailto:orders@greencrosspharmacy.com" class="btn" style="font-size:14px;padding:10px 22px;">Email Us</a>
    </div>
    <div style="background:white;border-radius:16px;padding:30px;text-align:center;box-shadow:0 4px 24px rgba(0,0,0,0.08);border:1px solid #e0e0e0;">
      <div style="font-size:36px;margin-bottom:14px;">👨‍⚕️</div>
      <h3 style="font-size:17px;font-weight:600;margin-bottom:8px;">Free Consultation</h3>
      <p style="font-size:14px;color:#555;margin-bottom:16px;">Speak directly with one of our pharmacists about your medications or health questions.</p>
      <a href="services.html" class="btn" style="font-size:14px;padding:10px 22px;">Our Services</a>
    </div>
  </div>
</section>

<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <div class="footer-logo-text">GreenCross Pharmacy</div>
      <p>Your trusted pharmacy and healthcare provider delivering quality medicines, professional pharmaceutical services, and genuine health products.</p>
      <div class="footer-social">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>
    <div><h3>Quick Links</h3><ul><li><a href="index.html">Home</a></li><li><a href="about.html">About Us</a></li><li><a href="services.html">Our Services</a></li><li><a href="products.html">Products</a></li><li><a href="blog.html">Health Blog</a></li><li><a href="contact.html">Contact</a></li></ul></div>
    <div><h3>Services</h3><ul><li><a href="services.html">Prescription Filling</a></li><li><a href="services.html">Medicine Delivery</a></li><li><a href="services.html">Health Consultation</a></li><li><a href="services.html">Medical Equipment</a></li></ul></div>
    <div class="footer-hours">
      <h3>Contact & Hours</h3>
      <p><i class="fas fa-map-marker-alt" style="margin-right:8px;opacity:0.7;"></i>Suite 06,Plot 616, 1st Avenue,
Opposite Drumstix, Gwarimpa, Abuja</p><br>
      <p><i class="fas fa-phone" style="margin-right:8px;opacity:0.7;"></i>+234 800 123 4567</p>
      <p><i class="fas fa-envelope" style="margin-right:8px;opacity:0.7;"></i>info@greencrosspharmacy.com</p><br>
      <p><strong>Mon – Fri:</strong> 8:00 AM – 8:00 PM</p>
      <p><strong>Saturday:</strong> 9:00 AM – 6:00 PM</p>
    </div>
  </div>
  <div class="footer-bottom">
    <span>© 2025 GreenCross Pharmacy. All rights reserved.</span>
    <span>Designed for better healthcare access.</span>
  </div>
</footer>

<a href="https://web.whatsapp.com/" class="whatsapp"><i class="fab fa-whatsapp"></i> WhatsApp</a>
<script src="js/script.js"></script>

</body>
</html>
