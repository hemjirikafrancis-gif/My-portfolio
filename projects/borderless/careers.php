<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Careers – Borderless Analysts</title>
  <meta name="description" content="Join the Borderless Analysts team. Explore exciting career opportunities in business analysis, data analytics, AI automation, and more." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <style>
    .culture-section { padding: 96px 0; }
    .culture-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 28px; margin-top: 48px; }
    .culture-card { background: var(--light-bg); border-radius: var(--radius-lg); padding: 36px 28px; text-align: center; transition: var(--transition); }
    .culture-card:hover { background: var(--primary); transform: translateY(-4px); }
    .culture-card:hover h3,.culture-card:hover p { color: var(--white); }
    .culture-icon { font-size: 2.8rem; margin-bottom: 18px; }
    .culture-card p { color: var(--gray); font-size: 0.93rem; margin: 0; }
    .jobs-section { background: var(--light-bg); padding: 96px 0; }
    .job-card { background: var(--white); border-radius: var(--radius-lg); padding: 32px; box-shadow: var(--shadow); margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; gap: 24px; flex-wrap: wrap; transition: var(--transition); border-left: 4px solid transparent; }
    .job-card:hover { border-left-color: var(--accent); box-shadow: var(--shadow-lg); }
    .job-info h3 { margin-bottom: 8px; font-size: 1.15rem; }
    .job-tags { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px; }
    .job-tag { background: var(--light-bg); color: var(--primary); font-size: 0.8rem; font-weight: 700; padding: 4px 12px; border-radius: 20px; }
    .job-tag.accent { background: rgba(232,160,32,0.12); color: var(--accent); }
    .perks-section { padding: 96px 0; }
    .perks-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 24px; margin-top: 48px; }
    .perk-item { text-align: center; padding: 32px 20px; border-radius: var(--radius); background: var(--light-bg); }
    .perk-icon { font-size: 2.4rem; margin-bottom: 14px; }
    .perk-item h4 { margin-bottom: 8px; font-size: 1rem; }
    .perk-item p { color: var(--gray); font-size: 0.88rem; margin: 0; }
    @media(max-width:1024px){ .culture-grid { grid-template-columns: 1fr 1fr; } .perks-grid { grid-template-columns: 1fr 1fr; } }
    @media(max-width:768px){ .culture-grid,.perks-grid { grid-template-columns: 1fr; } .job-card { flex-direction: column; align-items: flex-start; } }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="careers-page">
  <div class="top-bar"><div class="top-bar-inner"><div class="top-bar-left"><a href="tel:+2348055336626"><i class="fa-solid fa-phone"></i> +234 805 533 6626</a><a href="tel:+447732034572"><i class="fa-solid fa-phone"></i> +44 773 203 4572</a></div><div class="top-bar-right"><a href="mailto:info@borderlessanalysts.com">✉ info@borderlessanalysts.com</a></div></div></div>

  <header class="site-header" id="site-header">
    <div class="header-inner">
      
<a href="index.php" class="logo">
  <img src="images/borderles-analyst-logo.png" alt="Borderless Analysts Logo" class="site-logo-img">
</a>

      <nav>
        <a href="index.php" class="nav-link">Home</a>
        <a href="about.php" class="nav-link">About Us</a>
        <div class="dropdown"><a href="services.php" class="nav-link dropdown-toggle">Services</a><div class="dropdown-menu"><a href="services.php#business-analysis">Business Analysis</a><a href="services.php#financial-analysis">Financial Analysis</a><a href="services.php#data-analysis">Data Analysis</a><a href="services.php#hr-analysis">HR Analysis</a><a href="services.php#change-management">Change Management</a><a href="services.php#ai-automation">AI &amp; Automation</a></div></div>
        <div class="dropdown"><a href="#" class="nav-link dropdown-toggle">Insights &amp; Resources</a><div class="dropdown-menu"><a href="case-studies.php">Case Studies</a><a href="whitepapers.php">Whitepapers</a><a href="blog.php">News &amp; Blog</a></div></div>
        <a href="careers.php" class="nav-link active">Careers</a>
        <a href="contact.php" class="nav-link">Contact Us</a>
      </nav>
      <a href="contact.php" class="btn btn-primary header-cta">Get Started</a>
      <button class="hamburger" id="hamburger"><span></span><span></span><span></span></button>
    </div>
  </header>

  <div class="mobile-overlay" id="mobile-menu">
    <div class="mobile-header"><div class="logo-text" style="color:#fff;">Borderless<br><span style="color:var(--accent)">Analysts</span></div><button class="mobile-close" id="mobile-close">&times;</button></div>
    <nav class="mobile-nav"><a href="index.php">Home</a><a href="about.php">About Us</a><a href="services.php">Services</a><a href="blog.php">Blog</a><a href="careers.php">Careers</a><a href="contact.php">Contact Us</a></nav>
    <div class="mobile-cta"><a href="contact.php" class="btn btn-primary" style="width:100%;justify-content:center;">Get Started</a></div>
  </div>

  <section class="page-hero">
    <div class="container"><div class="page-hero-content">
      <div class="breadcrumb"><a href="index.php">Home</a><span>›</span><span>Careers</span></div>
      <h1>Join Our Team</h1>
      <p>We're building a world-class team of analysts, strategists, and AI specialists. If you're passionate about solving complex problems and driving real impact — we'd love to hear from you.</p>
    </div></div>
  </section>

  <!-- CULTURE -->
  <section class="culture-section">
    <div class="container">
      <div class="text-center fade-up">
        <span class="section-label">Life at Borderless</span>
        <h2 class="section-title">Our Culture &amp; Values</h2>
        <div class="divider divider-center"></div>
        <p class="section-desc" style="margin:0 auto;">We foster a culture of collaboration, innovation, and continuous learning — where every team member's contribution makes a real difference.</p>
      </div>
      <div class="culture-grid">
        <div class="culture-card fade-up"><div class="culture-icon">🚀</div><h3>Growth Mindset</h3><p>We invest in our people. Every team member receives a personal development budget, access to training, and mentorship from industry leaders.</p></div>
        <div class="culture-card fade-up"><div class="culture-icon">🌍</div><h3>Global Exposure</h3><p>Work with clients across Africa, Europe, and beyond. Our projects span industries and borders, giving you unmatched experience.</p></div>
        <div class="culture-card fade-up"><div class="culture-icon">🤝</div><h3>Collaborative Team</h3><p>We believe great ideas come from collaboration. Our open culture encourages knowledge sharing and cross-functional teamwork.</p></div>
        <div class="culture-card fade-up"><div class="culture-icon">⚖️</div><h3>Work-Life Balance</h3><p>Flexible working arrangements, hybrid options, and generous leave policies because we know balance drives better performance.</p></div>
        <div class="culture-card fade-up"><div class="culture-icon">🤖</div><h3>Innovation First</h3><p>Work at the cutting edge of AI and analytics. We encourage experimentation and reward bold, creative thinking.</p></div>
        <div class="culture-card fade-up"><div class="culture-icon">🏅</div><h3>Recognition &amp; Reward</h3><p>Competitive compensation, performance bonuses, and a culture that celebrates wins — big and small.</p></div>
      </div>
    </div>
  </section>

  <!-- OPEN ROLES -->
  <section class="jobs-section">
    <div class="container">
      <div class="text-center fade-up">
        <span class="section-label">Open Positions</span>
        <h2 class="section-title">Current Opportunities</h2>
        <div class="divider divider-center"></div>
        <p class="section-desc" style="margin:0 auto;">Explore our current openings. Don't see a perfect match? Send us your CV — we're always looking for exceptional talent.</p>
      </div>
      <div style="margin-top:48px;">
        <div class="job-card fade-up">
          <div class="job-info">
            <h3>Senior Business Analyst</h3>
            <p style="color:var(--gray);font-size:0.93rem;margin:0;">Lead complex business analysis engagements, define requirements, and deliver strategic recommendations for enterprise clients.</p>
            <div class="job-tags"><span class="job-tag">Full-time</span><span class="job-tag">Lagos / Remote</span><span class="job-tag accent">Business Analysis</span></div>
          </div>
          <a href="contact.php" class="btn btn-primary">Apply Now</a>
        </div>
        <div class="job-card fade-up">
          <div class="job-info">
            <h3>AI Automation Engineer</h3>
            <p style="color:var(--gray);font-size:0.93rem;margin:0;">Design, build, and deploy AI-powered automation solutions for our clients across customer service, finance, and marketing.</p>
            <div class="job-tags"><span class="job-tag">Full-time</span><span class="job-tag">Lagos / London / Remote</span><span class="job-tag accent">AI &amp; Automation</span></div>
          </div>
          <a href="contact.php" class="btn btn-primary">Apply Now</a>
        </div>
        <div class="job-card fade-up">
          <div class="job-info">
            <h3>Data Analyst</h3>
            <p style="color:var(--gray);font-size:0.93rem;margin:0;">Turn complex datasets into actionable intelligence. Build dashboards, conduct statistical analysis, and communicate insights to clients.</p>
            <div class="job-tags"><span class="job-tag">Full-time</span><span class="job-tag">Lagos / Remote</span><span class="job-tag accent">Data Analytics</span></div>
          </div>
          <a href="contact.php" class="btn btn-primary">Apply Now</a>
        </div>
        <div class="job-card fade-up">
          <div class="job-info">
            <h3>Financial Analyst</h3>
            <p style="color:var(--gray);font-size:0.93rem;margin:0;">Deliver financial modelling, forecasting, and strategic advisory services to clients across banking, FMCG, and tech sectors.</p>
            <div class="job-tags"><span class="job-tag">Full-time</span><span class="job-tag">London / Hybrid</span><span class="job-tag accent">Finance</span></div>
          </div>
          <a href="contact.php" class="btn btn-primary">Apply Now</a>
        </div>
        <div class="job-card fade-up">
          <div class="job-info">
            <h3>HR Analytics Consultant</h3>
            <p style="color:var(--gray);font-size:0.93rem;margin:0;">Help clients unlock the power of people data. Design HR metrics frameworks, run workforce analytics, and present strategic insights.</p>
            <div class="job-tags"><span class="job-tag">Full-time</span><span class="job-tag">Remote</span><span class="job-tag accent">HR Analytics</span></div>
          </div>
          <a href="contact.php" class="btn btn-primary">Apply Now</a>
        </div>
        <div class="job-card fade-up">
          <div class="job-info">
            <h3>Change Management Specialist</h3>
            <p style="color:var(--gray);font-size:0.93rem;margin:0;">Guide organisations through digital and operational transformations, developing change strategies and stakeholder engagement plans.</p>
            <div class="job-tags"><span class="job-tag">Full-time</span><span class="job-tag">Lagos / London</span><span class="job-tag accent">Change Management</span></div>
          </div>
          <a href="contact.php" class="btn btn-primary">Apply Now</a>
        </div>
      </div>
    </div>
  </section>

  <!-- PERKS -->
  <section class="perks-section">
    <div class="container">
      <div class="text-center fade-up">
        <span class="section-label">Why Work With Us</span>
        <h2 class="section-title">Perks &amp; Benefits</h2>
        <div class="divider divider-center"></div>
      </div>
      <div class="perks-grid">
        <div class="perk-item fade-up"><div class="perk-icon">💰</div><h4>Competitive Salary</h4><p>Market-leading compensation packages reviewed annually with performance-based bonuses.</p></div>
        <div class="perk-item fade-up"><div class="perk-icon">🏡</div><h4>Flexible / Remote Work</h4><p>Hybrid and fully remote options available depending on role and location.</p></div>
        <div class="perk-item fade-up"><div class="perk-icon">📚</div><h4>Learning &amp; Development</h4><p>Annual learning budget, professional certifications, and access to top-tier training platforms.</p></div>
        <div class="perk-item fade-up"><div class="perk-icon">🏥</div><h4>Health &amp; Wellbeing</h4><p>Comprehensive health insurance, wellness allowances, and mental health support resources.</p></div>
        <div class="perk-item fade-up"><div class="perk-icon">✈️</div><h4>Travel Opportunities</h4><p>Opportunity to work across our Lagos and London offices and travel to client sites globally.</p></div>
        <div class="perk-item fade-up"><div class="perk-icon">🌱</div><h4>Career Growth</h4><p>Clear career progression pathways and access to senior mentorship from day one.</p></div>
        <div class="perk-item fade-up"><div class="perk-icon">🎉</div><h4>Team Events</h4><p>Regular team socials, retreats, and celebrations of milestones and individual achievements.</p></div>
        <div class="perk-item fade-up"><div class="perk-icon">⏰</div><h4>Generous Leave</h4><p>Competitive annual leave entitlement plus paid sick leave and parental leave policies.</p></div>
      </div>
    </div>
  </section>

  <!-- OPEN APPLICATION CTA -->
  <section class="insights-cta">
    <div class="container">
      <div class="insights-inner">
        <div class="insights-text">
          <span class="section-label">Don't See Your Role?</span>
          <h2 class="section-title">Send Us Your CV</h2>
          <p>We're always on the lookout for exceptional talent. If you're passionate about analytics, AI, and business transformation — reach out and introduce yourself.</p>
        </div>
        <div><a href="contact.php" class="btn btn-primary" style="font-size:1.05rem;padding:15px 32px;">Get In Touch</a></div>
      </div>
    </div>
  </section>

  <footer class="site-footer"><div class="container">
    <div class="footer-grid">
      <div class="footer-brand"><div class="logo-text" style="color:#fff;font-size:1.4rem;">Borderless<br><span style="color:var(--accent)">Analysts</span></div><p>Empowering businesses with global insights and strategic excellence.</p><div class="footer-social">
        <a href="https://www.instagram.com/accounts/login/?hl=en" class="social-btn">📸</a>
        <a href="https://x.com/?lang=en" class="social-btn"><i class="fa-brands fa-x-twitter"></i></a>
        <a href="https://www.facebook.com/login/" class="social-btn">👤</a>
        <a href="https://www.linkedin.com/login" class="social-btn"><i class="fa-brands fa-linkedin"></i></a>
      </div>
    </div>
      <div class="footer-col"><h4>Company</h4><div class="footer-links"><a href="index.php">Home</a><a href="about.php">About Us</a><a href="services.php">Services</a><a href="careers.php">Careers</a><a href="contact.php">Contact Us</a></div></div>
      <div class="footer-col"><h4>Services</h4><div class="footer-links"><a href="services.php#business-analysis">Business Analysis</a><a href="services.php#financial-analysis">Financial Analysis</a><a href="services.php#data-analysis">Data Analysis</a><a href="services.php#ai-automation">AI Automation</a></div></div>
      <div class="footer-col"><h4>Contact</h4><div class="footer-contact-item"><span class="fci-icon"><i class="fa-solid fa-phone"></i></span><div><a href="tel:+2348055336626">+234 805 533 6626</a><br><a href="tel:+447732034572">+44 773 203 4572</a></div></div><div class="footer-contact-item"><span class="fci-icon"><i class="fa-solid fa-envelope"></i></span><a href="mailto:info@borderlessanalysts.com">info@borderlessanalysts.com</a></div></div>
    </div>
    <div class="footer-bottom"><p>&copy; 2024 Borderless Analysts. All rights reserved.</p><div class="footer-bottom-links"><a href="#">Privacy Policy</a><a href="#">Terms of Service</a></div></div>
  </div></footer>
  <button class="scroll-top" id="scroll-top">↑</button>
  <script src="script.js"></script>
</body>
</html>
