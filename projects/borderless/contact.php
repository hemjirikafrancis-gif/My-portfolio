<?php require_once __DIR__ . '/includes/contact-handler.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us – Borderless Analysts</title>
  <meta name="description" content="Get in touch with Borderless Analysts. We're ready to help you transform your business with expert analysis and AI-powered solutions." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <style>
    .contact-main { padding: 96px 0; }
    .contact-main-inner { display: grid; grid-template-columns: 1fr 1.4fr; gap: 72px; align-items: start; }
    .contact-cards { display: flex; flex-direction: column; gap: 20px; margin-top: 32px; }
    .contact-card { background: var(--light-bg); border-radius: var(--radius); padding: 24px; display: flex; align-items: flex-start; gap: 18px; border-left: 4px solid var(--accent); transition: var(--transition); }
    .contact-card:hover { background: var(--primary); }
    .contact-card:hover h4, .contact-card:hover p, .contact-card:hover a { color: var(--white); }
    .contact-card-icon { font-size: 1.8rem; flex-shrink: 0; }
    .contact-card h4 { font-size: 0.85rem; color: var(--gray); margin-bottom: 4px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
    .contact-card p, .contact-card a { color: var(--primary); font-weight: 600; font-size: 0.97rem; margin: 0; }
    .big-form { background: var(--white); border-radius: var(--radius-lg); padding: 48px; box-shadow: var(--shadow-lg); border-top: 4px solid var(--accent); }
    .big-form h2 { margin-bottom: 8px; }
    .big-form > p { color: var(--gray); margin-bottom: 32px; }
    .map-section { background: var(--primary); padding: 80px 0; }
    .map-placeholder { background: rgba(255,255,255,0.06); border-radius: var(--radius-lg); padding: 80px 40px; text-align: center; border: 2px dashed rgba(255,255,255,0.15); }
    .map-placeholder span { font-size: 4rem; display: block; margin-bottom: 16px; }
    .map-placeholder p { color: rgba(255,255,255,0.7); margin: 0; }
    .faq-section { padding: 80px 0; background: var(--light-bg); }
    .faq-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 48px; }
    .faq-item { background: var(--white); border-radius: var(--radius); padding: 28px; box-shadow: var(--shadow); }
    .faq-item h4 { color: var(--primary); margin-bottom: 10px; font-size: 1rem; }
    .faq-item p { color: var(--gray); font-size: 0.92rem; margin: 0; }
    @media(max-width:1024px){ .contact-main-inner { grid-template-columns: 1fr; } .faq-grid { grid-template-columns: 1fr; } }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="contact-page">

  <div class="top-bar">
    <div class="top-bar-inner">
      <div class="top-bar-left">
        <a href="tel:+2348055336626"><i class="fa-solid fa-phone"></i> +234 805 533 6626</a>
        <a href="tel:+447732034572"><i class="fa-solid fa-phone"></i> +44 773 203 4572</a>
      </div>
      <div class="top-bar-right">
        <a href="mailto:info@borderlessanalysts.com">✉ info@borderlessanalysts.com</a>
      </div>
    </div>
  </div>

  <header class="site-header" id="site-header">
    <div class="header-inner">
      
<a href="index.php" class="logo">
  <img src="images/borderles-analyst-logo.png" alt="Borderless Analysts Logo" class="site-logo-img">
</a>

      <nav>
        <a href="index.php" class="nav-link">Home</a>
        <a href="about.php" class="nav-link">About Us</a>
        <div class="dropdown">
          <a href="services.php" class="nav-link dropdown-toggle">Services</a>
          <div class="dropdown-menu">
            <a href="services.php#business-analysis">Business Analysis</a>
            <a href="services.php#financial-analysis">Financial Analysis</a>
            <a href="services.php#data-analysis">Data Analysis</a>
            <a href="services.php#hr-analysis">HR Analysis</a>
            <a href="services.php#change-management">Change Management</a>
            <a href="services.php#ai-automation">AI &amp; Automation</a>
          </div>
        </div>
        <div class="dropdown">
          <a href="#" class="nav-link dropdown-toggle">Insights &amp; Resources</a>
          <div class="dropdown-menu">
            <a href="case-studies.php">Case Studies</a>
            <a href="whitepapers.php">Whitepapers &amp; Reports</a>
            <a href="blog.php">News &amp; Blog</a>
          </div>
        </div>
        <a href="careers.php" class="nav-link">Careers</a>
        <a href="contact.php" class="nav-link active">Contact Us</a>
      </nav>
      <a href="contact.php" class="btn btn-primary header-cta">Get Started</a>
      <button class="hamburger" id="hamburger"><span></span><span></span><span></span></button>
    </div>
  </header>

  <div class="mobile-overlay" id="mobile-menu">
    <div class="mobile-header">
      <div class="logo-text" style="color:#fff;">Borderless<br><span style="color:var(--accent)">Analysts</span></div>
      <button class="mobile-close" id="mobile-close">&times;</button>
    </div>
    <nav class="mobile-nav">
      <a href="index.php">Home</a><a href="about.php">About Us</a>
      <a href="services.php">Services</a><a href="blog.php">News &amp; Blog</a>
      <a href="careers.php">Careers</a><a href="contact.php">Contact Us</a>
    </nav>
    <div class="mobile-cta"><a href="contact.php" class="btn btn-primary" style="width:100%;justify-content:center;">Get Started</a></div>
  </div>

  <section class="page-hero">
    <div class="container">
      <div class="page-hero-content">
        <div class="breadcrumb"><a href="index.php">Home</a><span>›</span><span>Contact Us</span></div>
        <h1>Get In Touch</h1>
        <p>We'd love to hear from you. Whether you have a question about our services, want to discuss a project, or are ready to start your transformation — our team is ready to help.</p>
      </div>
    </div>
  </section>

  <section class="contact-main">
    <div class="container">
      <div class="contact-main-inner">
        <div class="fade-up">
          <span class="section-label">Contact Information</span>
          <h2 class="section-title">Let's Start a Conversation</h2>
          <div class="divider"></div>
          <p style="color:var(--gray);">Reach out through any of the channels below. Our expert team typically responds within 24 hours on business days.</p>
          <div class="contact-cards">
            <div class="contact-card">
              <div class="contact-card-icon">📞</div>
              <div>
                <h4>Phone – Nigeria</h4>
                <a href="tel:+2348055336626">+234 805 533 6626</a>
              </div>
            </div>
            <div class="contact-card">
              <div class="contact-card-icon">📞</div>
              <div>
                <h4>Phone – United Kingdom</h4>
                <a href="tel:+447732034572">+44 773 203 4572</a>
              </div>
            </div>
            <div class="contact-card">
              <div class="contact-card-icon">✉️</div>
              <div>
                <h4>Email Address</h4>
                <a href="mailto:info@borderlessanalysts.com">info@borderlessanalysts.com</a>
              </div>
            </div>
            <div class="contact-card">
              <div class="contact-card-icon">🕐</div>
              <div>
                <h4>Business Hours</h4>
                <p>Mon – Fri: 9:00 AM – 6:00 PM (GMT / WAT)</p>
              </div>
            </div>
            <div class="contact-card">
              <div class="contact-card-icon">🌐</div>
              <div>
                <h4>Global Offices</h4>
                <p>Lagos, Nigeria &nbsp;|&nbsp; London, United Kingdom</p>
              </div>
            </div>
          </div>
          <div style="margin-top:32px;">
            <p style="font-weight:700;color:var(--primary);margin-bottom:14px;">Connect With Us</p>
            <div style="display:flex;gap:12px;">
              <a href="#" class="social-btn" style="background:var(--light-bg);color:var(--primary);border:1px solid var(--border);">📸</a>
              <a href="#" class="social-btn" style="background:var(--light-bg);color:var(--primary);border:1px solid var(--border);"><i class="fa-brands fa-x-twitter"></i></a>
              <a href="#" class="social-btn" style="background:var(--light-bg);color:var(--primary);border:1px solid var(--border);">👤</a>
              <a href="#" class="social-btn" style="background:var(--light-bg);color:var(--primary);border:1px solid var(--border);"><i class="fa-brands fa-linkedin"></i></a>
            </div>
          </div>
        </div>
        <div class="fade-up">
          <div class="big-form">
            <h2>Send Us a Message</h2>
            <p>Fill in the form below and one of our experts will get back to you shortly.</p>

            <?php if ($formStatus === 'success'): ?>
              <div style="background:#e6f7ec;border:1px solid #34a853;color:#1e7e34;padding:14px 18px;border-radius:8px;margin-bottom:20px;font-size:0.92rem;">
                ✅ Thanks! Your message has been sent successfully. We'll get back to you shortly.
              </div>
            <?php elseif ($formStatus === 'error'): ?>
              <div style="background:#fdecea;border:1px solid #e53935;color:#c62828;padding:14px 18px;border-radius:8px;margin-bottom:20px;font-size:0.92rem;">
                ⚠️ <?php echo e($formError); ?>
              </div>
            <?php endif; ?>

            <?php if ($formDebug !== ''): ?>
              <details style="margin-bottom:20px;">
                <summary style="cursor:pointer;font-weight:700;color:var(--primary);font-size:0.85rem;">🔍 Diagnostic transcript (remove this block once mail is confirmed working)</summary>
                <pre style="background:#1b1e27;color:#d8dee9;padding:14px;border-radius:8px;font-size:0.75rem;overflow-x:auto;white-space:pre-wrap;margin-top:10px;"><?php echo e($formDebug); ?></pre>
              </details>
            <?php endif; ?>

            <form action="contact.php" method="POST" novalidate>
              <div class="form-row">
                <div class="form-group">
                  <label>First Name *</label>
                  <input type="text" name="first_name" placeholder="John" value="<?php echo e($old['first_name']); ?>" required />
                </div>
                <div class="form-group">
                  <label>Last Name *</label>
                  <input type="text" name="last_name" placeholder="Doe" value="<?php echo e($old['last_name']); ?>" required />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label>Email Address *</label>
                  <input type="email" name="email" placeholder="john@company.com" value="<?php echo e($old['email']); ?>" required />
                </div>
                <div class="form-group">
                  <label>Phone Number</label>
                  <input type="tel" name="phone" placeholder="+1 234 567 8900" value="<?php echo e($old['phone']); ?>" />
                </div>
              </div>
              <div class="form-group">
                <label>Company / Organisation</label>
                <input type="text" name="company" placeholder="Your company name" value="<?php echo e($old['company']); ?>" />
              </div>
              <div class="form-group">
                <label>Service of Interest *</label>
                <select name="service" style="width:100%;padding:12px 15px;border:1.5px solid var(--border);border-radius:8px;font-family:var(--font-body);font-size:0.95rem;color:var(--text);background:var(--white);outline:none;" required>
                  <option value="">— Select a service —</option>
                  <?php
                  $services = ['Business Analysis','Financial Analysis','Data Analysis','HR Analysis','Change Management','Business Re-engineering','AI & Business Process Automation','General Enquiry'];
                  foreach ($services as $svc):
                  ?>
                    <option <?php echo ($old['service'] === $svc) ? 'selected' : ''; ?>><?php echo e($svc); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Your Message *</label>
                <textarea name="message" placeholder="Tell us about your project, challenge, or question..." required><?php echo e($old['message']); ?></textarea>
              </div>
              <button type="submit" name="contact_submit" value="1" class="btn btn-primary" style="width:100%;justify-content:center;padding:15px;font-size:1rem;">Send Message →</button>
              <p style="font-size:0.82rem;color:var(--gray);margin-top:14px;text-align:center;">We respect your privacy. Your information will never be shared with third parties.</p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="map-section">
    <div class="container">
      <div class="text-center" style="margin-bottom:40px;">
        <span class="section-label">Our Locations</span>
        <h2 style="color:var(--white);">Find Us Globally</h2>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:28px;">
        <div class="map-placeholder fade-up">
          <span>🇳🇬</span>
          <h3 style="color:var(--accent);margin-bottom:8px;">Lagos, Nigeria</h3>
          <p>Our headquarters serving West Africa and the broader African continent.</p>
        </div>
        <div class="map-placeholder fade-up">
          <span>🇬🇧</span>
          <h3 style="color:var(--accent);margin-bottom:8px;">London, United Kingdom</h3>
          <p>Our European hub serving clients across the UK and continental Europe.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="faq-section">
    <div class="container">
      <div class="text-center fade-up">
        <span class="section-label">Common Questions</span>
        <h2 class="section-title">Frequently Asked Questions</h2>
        <div class="divider divider-center"></div>
      </div>
      <div class="faq-grid">
        <div class="faq-item fade-up">
          <h4>How quickly can we get started?</h4>
          <p>After an initial consultation, most projects can commence within 1–2 weeks. We move fast without compromising quality.</p>
        </div>
        <div class="faq-item fade-up">
          <h4>Do you work with small businesses?</h4>
          <p>Absolutely. We serve organisations of all sizes — from ambitious startups to established enterprises across multiple sectors.</p>
        </div>
        <div class="faq-item fade-up">
          <h4>What does an AI automation engagement look like?</h4>
          <p>We begin with a discovery workshop, then design a custom automation roadmap, build and test the solution, and support deployment and ongoing optimisation.</p>
        </div>
        <div class="faq-item fade-up">
          <h4>How do you measure success?</h4>
          <p>We agree on clear KPIs before any engagement begins — whether that's cost savings, efficiency gains, customer satisfaction scores, or revenue growth.</p>
        </div>
        <div class="faq-item fade-up">
          <h4>Do you offer ongoing support after project delivery?</h4>
          <p>Yes. We offer flexible retainer and support packages to ensure your solutions continue to perform and evolve with your business.</p>
        </div>
        <div class="faq-item fade-up">
          <h4>Is my data safe with Borderless Analysts?</h4>
          <p>Data security is paramount. We operate under strict confidentiality agreements and comply with GDPR and relevant data protection regulations.</p>
        </div>
      </div>
    </div>
  </section>

  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="logo-text" style="color:#fff;font-size:1.4rem;">Borderless<br><span style="color:var(--accent)">Analysts</span></div>
          <p>Empowering businesses with global insights and strategic excellence.</p>
          <div class="footer-social">
            <a href="https://www.instagram.com/accounts/login/?hl=en" class="social-btn">📸</a>
            <a href="https://x.com/?lang=en" class="social-btn"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="https://www.facebook.com/login/" class="social-btn">👤</a>
            <a href="https://www.linkedin.com/login" class="social-btn"><i class="fa-brands fa-linkedin"></i></a>
          </div>
        </div>
        <div class="footer-col"><h4>Company</h4><div class="footer-links"><a href="index.php">Home</a><a href="about.php">About Us</a><a href="services.php">Services</a><a href="careers.php">Careers</a><a href="contact.php">Contact Us</a></div></div>
        <div class="footer-col"><h4>Services</h4><div class="footer-links"><a href="services.php#business-analysis">Business Analysis</a><a href="services.php#financial-analysis">Financial Analysis</a><a href="services.php#data-analysis">Data Analysis</a><a href="services.php#ai-automation">AI Automation</a></div></div>
        <div class="footer-col"><h4>Contact</h4>
          <div class="footer-contact-item"><span class="fci-icon"><i class="fa-solid fa-phone"></i></span><div><a href="tel:+2348055336626">+234 805 533 6626</a><br><a href="tel:+447732034572">+44 773 203 4572</a></div></div>
          <div class="footer-contact-item"><span class="fci-icon"><i class="fa-solid fa-envelope"></i></span><a href="mailto:info@borderlessanalysts.com">info@borderlessanalysts.com</a></div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2024 Borderless Analysts. All rights reserved.</p>
        <div class="footer-bottom-links"><a href="#">Privacy Policy</a><a href="#">Terms of Service</a></div>
      </div>
    </div>
  </footer>

  <button class="scroll-top" id="scroll-top">↑</button>
  <script src="script.js"></script>
</body>
</html>
