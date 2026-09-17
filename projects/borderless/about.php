<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us – Borderless Analysts</title>
  <meta name="description" content="Learn about Borderless Analysts — our mission, vision, team, and commitment to empowering businesses with global insights and strategic excellence." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <style>
    .mission-vision { padding: 96px 0; }
    .mv-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-top: 48px; }
    .mv-card { border-radius: var(--radius-lg); padding: 48px 40px; position: relative; overflow: hidden; }
    .mv-card-mission { background: var(--primary); }
    .mv-card-vision { background: var(--light-bg); border: 2px solid var(--border); }
    .mv-icon { font-size: 3rem; margin-bottom: 20px; }
    .mv-card-mission h3, .mv-card-mission p { color: var(--white); }
    .mv-card-mission h3 { color: var(--accent); }
    .mv-card-vision p { color: var(--gray); }
    .team-section { background: var(--light-bg); padding: 96px 0; }
    .team-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 28px; margin-top: 48px; }
    .team-card { background: var(--white); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow); transition: var(--transition); }
    .team-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
    .team-avatar { aspect-ratio: 1; background: linear-gradient(135deg, var(--primary), var(--primary-light)); display: flex; align-items: center; justify-content: center; font-size: 4rem; }
    .team-body { padding: 20px; text-align: center; }
    .team-body h4 { margin-bottom: 4px; }
    .team-role { font-size: 0.85rem; color: var(--accent); font-weight: 700; }
    .team-body p { font-size: 0.88rem; color: var(--gray); margin-top: 10px; margin-bottom: 0; }
    .why-us { padding: 96px 0; }
    .why-us-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; margin-top: 48px; }
    .why-us-card { text-align: center; padding: 40px 28px; border-radius: var(--radius-lg); background: var(--light-bg); transition: var(--transition); }
    .why-us-card:hover { background: var(--primary); }
    .why-us-card:hover h3, .why-us-card:hover p { color: var(--white); }
    .why-us-card .wu-icon { font-size: 2.8rem; margin-bottom: 18px; }
    .why-us-card h3 { margin-bottom: 12px; font-size: 1.15rem; }
    .why-us-card p { color: var(--gray); font-size: 0.93rem; margin: 0; }
    .timeline { padding: 96px 0; background: var(--light-bg); }
    .timeline-list { position: relative; max-width: 720px; margin: 48px auto 0; }
    .timeline-list::before { content: ''; position: absolute; left: 18px; top: 0; bottom: 0; width: 2px; background: var(--border); }
    .tl-item { display: flex; gap: 32px; margin-bottom: 40px; position: relative; }
    .tl-dot { width: 38px; height: 38px; border-radius: 50%; background: var(--accent); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.8rem; flex-shrink: 0; position: relative; z-index: 1; box-shadow: 0 0 0 6px var(--light-bg); }
    .tl-content { background: var(--white); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow); flex: 1; }
    .tl-year { font-size: 0.8rem; font-weight: 700; color: var(--accent); margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.1em; }
    .tl-content h4 { margin-bottom: 8px; }
    .tl-content p { color: var(--gray); font-size: 0.93rem; margin: 0; }
    @media(max-width:1024px){ .team-grid { grid-template-columns: repeat(2,1fr); } .mv-grid { grid-template-columns: 1fr; } .why-us-grid { grid-template-columns: repeat(2,1fr); } }
    @media(max-width:768px){ .team-grid { grid-template-columns: 1fr 1fr; } .why-us-grid { grid-template-columns: 1fr; } }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="about-page">

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
        <a href="about.php" class="nav-link active">About Us</a>
        <div class="dropdown">
          <a href="services.php" class="nav-link dropdown-toggle">Services</a>
          <div class="dropdown-menu">
            <a href="services.php#business-analysis">Business Analysis</a>
            <a href="services.php#financial-analysis">Financial Analysis</a>
            <a href="services.php#data-analysis">Data Analysis</a>
            <a href="services.php#hr-analysis">HR Analysis</a>
            <a href="services.php#change-management">Change Management</a>
            <a href="services.php#business-reengineering">Business Re-engineering</a>
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
        <a href="contact.php" class="nav-link">Contact Us</a>
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
      <a href="index.php">Home</a>
      <a href="about.php">About Us</a>
      <a href="services.php">Services</a>
      <a href="blog.php">News &amp; Blog</a>
      <a href="careers.php">Careers</a>
      <a href="contact.php">Contact Us</a>
    </nav>
    <div class="mobile-cta"><a href="contact.php" class="btn btn-primary" style="width:100%;justify-content:center;">Get Started</a></div>
  </div>

  <section class="page-hero">
    <div class="container">
      <div class="page-hero-content">
        <div class="breadcrumb"><a href="index.php">Home</a><span>›</span><span>About Us</span></div>
        <h1>About Borderless Analysts</h1>
        <p>We are a trusted global partner committed to empowering organisations with intelligent insights, strategic excellence, and cutting-edge AI solutions that drive measurable growth.</p>
      </div>
    </div>
  </section>

  <!-- MISSION & VISION -->
  <section class="mission-vision">
    <div class="container">
      <div class="text-center fade-up">
        <span class="section-label">Who We Are</span>
        <h2 class="section-title">Our Mission &amp; Vision</h2>
        <div class="divider divider-center"></div>
      </div>
      <div class="mv-grid">
        <div class="mv-card mv-card-mission fade-up">
          <div class="mv-icon">🎯</div>
          <h3>Our Mission</h3>
          <p>To empower organisations to make informed decisions, drive growth, and achieve their strategic goals through innovative strategies, data-driven insights, and intelligent AI solutions. We transform business challenges into opportunities for success.</p>
        </div>
        <div class="mv-card mv-card-vision fade-up">
          <div class="mv-icon">🔭</div>
          <h3>Our Vision</h3>
          <p>To be the world's leading borderless analytics firm — a company without boundaries that helps businesses everywhere reach their full potential through the power of data, intelligence, and strategic innovation.</p>
        </div>
      </div>
      <div style="margin-top:60px;">
        <div class="about-inner">
          <div class="about-img-wrap fade-up">
            <div class="about-img-placeholder">
              <span>🌍</span>
              <p>Global Business Solutions</p>
            </div>
            <div class="about-badge-wrap">
              <div class="about-badge-num">10+</div>
              <div class="about-badge-text">Years of Excellence</div>
            </div>
          </div>
          <div class="fade-up">
            <span class="section-label">Our Story</span>
            <h2 class="section-title">Built to Make a Difference</h2>
            <div class="divider"></div>
            <p>Welcome to Borderless Analysts, your trusted partner in delivering cutting-edge business solutions. Founded with a bold vision to break down the barriers that limit business growth, we have grown into a globally trusted consultancy with clients across multiple continents.</p>
            <p>We specialise in Business Analysis, Financial Analysis, Data Analysis, HR Analysis, Change Management, Business Re-engineering, and — most recently — AI-powered Business Process Automation. Our team of 87+ expert consultants and analysts brings deep industry knowledge and technical precision to every engagement.</p>
            <p>Our commitment is simple: we are not satisfied until our clients see real, measurable results. With a customer satisfaction rate of 88.6% and an average client growth rate of 2.6x, our track record speaks for itself.</p>
            <div style="margin-top:28px;">
              <a href="services.php" class="btn btn-dark">Our Services</a>
              <a href="contact.php" class="btn btn-primary" style="margin-left:14px;">Work With Us</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- STATS -->
  <div class="stats-banner">
    <div class="container">
      <div class="stats-grid">
        <div class="stat-item fade-up"><div class="stat-num">88.6%</div><div class="stat-label">Customer Satisfaction</div></div>
        <div class="stat-item fade-up"><div class="stat-num">87+</div><div class="stat-label">Expert Employees</div></div>
        <div class="stat-item fade-up"><div class="stat-num">2.6x</div><div class="stat-label">Average Client Growth</div></div>
        <div class="stat-item fade-up"><div class="stat-num">302M</div><div class="stat-label">Daily Data Points</div></div>
      </div>
    </div>
  </div>

  <!-- WHY CHOOSE US -->
  <section class="why-us">
    <div class="container">
      <div class="text-center fade-up">
        <span class="section-label">Our Edge</span>
        <h2 class="section-title">Why Choose Borderless Analysts?</h2>
        <div class="divider divider-center"></div>
        <p class="section-desc" style="margin:0 auto;">We combine global thinking with local expertise to deliver solutions that are both strategically sound and practically effective.</p>
      </div>
      <div class="why-us-grid">
        <div class="why-us-card fade-up">
          <div class="wu-icon">🏅</div>
          <h3>Proven Expertise</h3>
          <p>Our team of certified analysts and consultants brings decades of combined experience across diverse industries and global markets.</p>
        </div>
        <div class="why-us-card fade-up">
          <div class="wu-icon">🤖</div>
          <h3>AI-First Approach</h3>
          <p>We embed cutting-edge AI and machine learning into our solutions, ensuring our clients benefit from the latest advances in technology.</p>
        </div>
        <div class="why-us-card fade-up">
          <div class="wu-icon">🎯</div>
          <h3>Results-Driven</h3>
          <p>Every engagement is designed around measurable outcomes. We set clear KPIs from day one and hold ourselves accountable to delivering them.</p>
        </div>
        <div class="why-us-card fade-up">
          <div class="wu-icon">🌐</div>
          <h3>Global Perspective</h3>
          <p>With clients across multiple continents, we bring a truly borderless perspective to every business challenge we tackle.</p>
        </div>
        <div class="why-us-card fade-up">
          <div class="wu-icon">🤝</div>
          <h3>Long-Term Partnership</h3>
          <p>We don't just deliver a project and walk away. We build lasting relationships that evolve with your business over time.</p>
        </div>
        <div class="why-us-card fade-up">
          <div class="wu-icon">✅</div>
          <h3>Transparent &amp; Reliable</h3>
          <p>Clear communication, honest reporting, and dependable delivery are non-negotiable standards at Borderless Analysts.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- TEAM -->
  <section class="team-section">
    <div class="container">
      <div class="text-center fade-up">
        <span class="section-label">Meet the Experts</span>
        <h2 class="section-title">Our Leadership Team</h2>
        <div class="divider divider-center"></div>
        <p class="section-desc" style="margin:0 auto;">Our leadership team combines deep industry knowledge with visionary thinking to guide Borderless Analysts and our clients toward excellence.</p>
      </div>
      <div class="team-grid">
        <div class="team-card fade-up">
          <div class="team-avatar">👨‍💼</div>
          <div class="team-body">
            <h4>David Okonkwo</h4>
            <div class="team-role">Chief Executive Officer</div>
            <p>Strategic visionary with 15+ years leading global business transformation initiatives across Africa, Europe, and North America.</p>
          </div>
        </div>
        <div class="team-card fade-up">
          <div class="team-avatar">👩‍💻</div>
          <div class="team-body">
            <h4>Amara Nwosu</h4>
            <div class="team-role">Chief Technology Officer</div>
            <p>AI and data engineering specialist driving our technology roadmap and enterprise AI automation deployments.</p>
          </div>
        </div>
        <div class="team-card fade-up">
          <div class="team-avatar">👨‍🔬</div>
          <div class="team-body">
            <h4>James Thornton</h4>
            <div class="team-role">Head of Financial Analysis</div>
            <p>Former investment banker with deep expertise in financial modelling, risk assessment, and strategic financial planning.</p>
          </div>
        </div>
        <div class="team-card fade-up">
          <div class="team-avatar">👩‍🎓</div>
          <div class="team-body">
            <h4>Fatima Al-Hassan</h4>
            <div class="team-role">Head of HR Analytics</div>
            <p>Workforce strategy expert helping global organisations build high-performance teams through data-driven people analytics.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TIMELINE -->
  <section class="timeline">
    <div class="container">
      <div class="text-center fade-up">
        <span class="section-label">Our Journey</span>
        <h2 class="section-title">Company Milestones</h2>
        <div class="divider divider-center"></div>
      </div>
      <div class="timeline-list">
        <div class="tl-item fade-up">
          <div class="tl-dot">2014</div>
          <div class="tl-content">
            <div class="tl-year">Founded</div>
            <h4>Borderless Analysts Established</h4>
            <p>Founded with a mission to break geographic barriers in business consulting, offering analytical services to SMEs across West Africa.</p>
          </div>
        </div>
        <div class="tl-item fade-up">
          <div class="tl-dot">2017</div>
          <div class="tl-content">
            <div class="tl-year">Expansion</div>
            <h4>International Growth</h4>
            <p>Expanded operations to the United Kingdom, establishing our London presence and growing our global client portfolio.</p>
          </div>
        </div>
        <div class="tl-item fade-up">
          <div class="tl-dot">2019</div>
          <div class="tl-content">
            <div class="tl-year">Innovation</div>
            <h4>Data &amp; AI Capabilities Launched</h4>
            <p>Invested heavily in data analytics infrastructure and launched our dedicated Data Analysis practice, serving Fortune 500 clients.</p>
          </div>
        </div>
        <div class="tl-item fade-up">
          <div class="tl-dot">2022</div>
          <div class="tl-content">
            <div class="tl-year">Recognition</div>
            <h4>Industry Recognition &amp; Team Growth</h4>
            <p>Reached 87+ employees, achieved 88.6% customer satisfaction rating, and began processing 302M daily data inputs for clients globally.</p>
          </div>
        </div>
        <div class="tl-item fade-up">
          <div class="tl-dot">2024</div>
          <div class="tl-content">
            <div class="tl-year">Future</div>
            <h4>AI Automation Services Launched</h4>
            <p>Launched our flagship AI Business Process Automation &amp; AI Solutions service, integrating intelligent automation into all core offerings.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- INSIGHTS CTA -->
  <section class="insights-cta">
    <div class="container">
      <div class="insights-inner">
        <div class="insights-text">
          <span class="section-label">Ready to Begin?</span>
          <h2 class="section-title">Let's Transform Your Business Together</h2>
          <p>Whether you need business analysis, financial intelligence, HR analytics, or AI automation — our expert team is ready to design a solution tailored to your needs.</p>
        </div>
        <div>
          <a href="contact.php" class="btn btn-primary" style="font-size:1.05rem;padding:15px 32px;">Get In Touch</a>
        </div>
      </div>
    </div>
  </section>

  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="logo-text" style="color:#fff;font-size:1.4rem;">Borderless<br><span style="color:var(--accent)">Analysts</span></div>
          <p>Empowering businesses with global insights and strategic excellence. Your trusted partner for AI automation, business analysis, and data-driven transformation.</p>
          <div class="footer-social">
            <a href="https://www.instagram.com/accounts/login/?hl=en" class="social-btn">📸</a>
            <a href="https://x.com/?lang=en" class="social-btn"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="https://www.facebook.com/login/" class="social-btn">👤</a>
            <a href="https://www.linkedin.com/login" class="social-btn"><i class="fa-brands fa-linkedin"></i></a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Company</h4>
          <div class="footer-links">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="services.php">Services</a>
            <a href="careers.php">Careers</a>
            <a href="contact.php">Contact Us</a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Services</h4>
          <div class="footer-links">
            <a href="services.php#business-analysis">Business Analysis</a>
            <a href="services.php#financial-analysis">Financial Analysis</a>
            <a href="services.php#data-analysis">Data Analysis</a>
            <a href="services.php#hr-analysis">HR Analysis</a>
            <a href="services.php#ai-automation">AI Automation</a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Contact</h4>
          <div class="footer-contact-item">
            <span class="fci-icon"><i class="fa-solid fa-phone"></i></span>
            <div><a href="tel:+2348055336626">+234 805 533 6626</a><br><a href="tel:+447732034572">+44 773 203 4572</a></div>
          </div>
          <div class="footer-contact-item">
            <span class="fci-icon"><i class="fa-solid fa-envelope"></i></span>
            <a href="mailto:info@borderlessanalysts.com">info@borderlessanalysts.com</a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2024 Borderless Analysts. All rights reserved.</p>
        <div class="footer-bottom-links">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Service</a>
          <a href="contact.php">Contact</a>
        </div>
      </div>
    </div>
  </footer>

  <button class="scroll-top" id="scroll-top">↑</button>
  <script src="script.js"></script>
</body>
</html>
