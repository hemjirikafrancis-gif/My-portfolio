<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$page='home';
$pageTitle='Wholesome Legal House – Reliable & Effective Legal Solutions';
include 'includes/header.php';

require __DIR__ . '/db.php';

// Self-heal table for environments where schema wasn't re-run
$conn->query("CREATE TABLE IF NOT EXISTS testimonials (
  id INT AUTO_INCREMENT PRIMARY KEY,
  author_name VARCHAR(150) NOT NULL,
  author_role VARCHAR(150) DEFAULT 'Client',
  email VARCHAR(180) DEFAULT NULL,
  image VARCHAR(255) DEFAULT NULL,
  message TEXT NOT NULL,
  approved TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

// Always start with the original three testimonials so they never disappear
$testimonials = [
  ['author_name'=>'Browncon Investment Finance','author_role'=>'Corporate Client','image'=>'Images/Testimonial-1.png','message'=>'Premium legal services with a human face. I recommend this firm any day.'],
  ['author_name'=>'Michael Elias','author_role'=>'Individual Client','image'=>'Images/Testimonial-2.png','message'=>'A great firm to handle your legal needs. Professional and result-driven.'],
  ['author_name'=>'Olusimidele Ogunnaike','author_role'=>'Individual Client','image'=>'Images/Testimonial-3.png','message'=>'Outstanding counsel and dedication to clients. Wholesome Legal truly delivers.'],
];
$res = $conn->query("SELECT author_name, author_role, image, message FROM testimonials WHERE approved = 1 ORDER BY id DESC LIMIT 30");
if ($res) { while ($r = $res->fetch_assoc()) { $testimonials[] = $r; } }
?>

<!-- HERO -->
<section class="hero" id="home">
    <div class="hero-slides">
        <div class="hero-slide active" style="background-image:url('Images/img-8.jpg')">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <p class="hero-sub">Trusted Legal Partners in Nigeria</p>
                <h1>Reliable &amp; Effective<br /><em>Legal Solutions</em></h1>
                <div class="hero-btns">
                    <a href="about.php" class="btn-primary">Know More</a>
                    <a href="services.php" class="btn-outline">View Services</a>
                </div>
            </div>
        </div>
        <div class="hero-slide" style="background-image:url('Images/img-9.jpg')">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <p class="hero-sub">Your Rights. Our Commitment.</p>
                <h1>The Right Way To<br /><em>Legal Help</em></h1>
                <div class="hero-btns">
                    <a href="about.php" class="btn-primary">Know More</a>
                    <a href="services.php" class="btn-outline">View Services</a>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-nav">
        <button class="hero-dot active" data-idx="0"></button>
        <button class="hero-dot" data-idx="1"></button>
    </div>
</section>

<!-- MISSION / VISION STRIP -->
<section class="mvb-strip">
    <div class="container">
        <div class="mvb-grid">
            <div class="mvb-card">
                <div class="mvb-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg></div>
                <h3>Vision</h3>
                <p>To be a leading law firm that protects and serves its clients' interests in the spirit of justice and
                    equity.</p>
            </div>
            <div class="mvb-card">
                <div class="mvb-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg></div>
                <h3>Mission</h3>
                <p>To add value to our clients by understanding their needs, objectives and goals and providing the
                    legal framework, skills and services to achieve them.</p>
            </div>
            <div class="mvb-card">
                <div class="mvb-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <polygon
                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                    </svg></div>
                <h3>Business Competitiveness</h3>
                <p>Wholesome Legal House is unique in that we take time to understand our clients' needs and provide
                    out-of-the-box solutions that meet their goals.</p>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT TEASER -->
<section class="about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-images">
                <div class="about-img-main"><img src="Images/Img-1.jpg" alt="Legal team" /></div>
            </div>
            <div class="about-content">
                <span class="section-label">About Us</span>
                <h2>Experienced Legal Counsel<br /><em>You Can Trust</em></h2>
                <p>Wholesome Legal House is engaged in general legal practice, with a slight emphasis on litigation. We
                    are a law firm engaged in personal and corporate law practice.</p>
                <p>We are experienced in providing corporate legal services for national and multinational companies,
                    combining deep expertise with a personal commitment to each client's success.</p>
                <div class="about-stats">
                    <div class="stat"><strong>10+</strong><span>Years Experience</span></div>
                    <div class="stat"><strong>200+</strong><span>Cases Handled</span></div>
                    <div class="stat"><strong>100%</strong><span>Client Dedication</span></div>
                </div>
                <a href="about.php" class="btn-primary">Learn More About Us</a>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES WE OFFER -->
<section class="home-services-section">
    <div class="container">
        <div class="section-header">
            <span class="section-label light">Services We Offer</span>
            <h2>Comprehensive Legal Solutions<br /><em>For Every Need</em></h2>
            <p>Whether you are an individual or a corporation, our qualified team is equipped to handle your legal
                matters with precision and care.</p>
        </div>
        <div class="home-services-grid">

            <div class="hs-card">
                <div class="hs-icon">
                    <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path d="M3 21h18M3 7v1a3 3 0 006 0V7m0 1a3 3 0 006 0V7m0 1a3 3 0 006 0V7H3l2-4h14l2 4" />
                        <path d="M5 21V10.85M19 21V10.85M9 21V10.85M15 21V10.85" />
                    </svg>
                </div>
                <h4>Civil &amp; Criminal Litigation</h4>
                <p>Engaging and defending general civil and criminal legal suits with strategic expertise and courtroom
                    precision.</p>
            </div>

            <div class="hs-card">
                <div class="hs-icon">
                    <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                        <line x1="16" y1="17" x2="8" y2="17" />
                    </svg>
                </div>
                <h4>Document Perfection</h4>
                <p>Mortgages, Assignments, Debentures and all other legal instruments — drafted and perfected to protect
                    your interests.</p>

            </div>

            <div class="hs-card">
                <div class="hs-icon">
                    <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <rect x="2" y="7" width="20" height="14" rx="2" />
                        <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
                    </svg>
                </div>
                <h4>Company Incorporation</h4>
                <p>Incorporation of companies and registration of business names across Nigeria, handled smoothly from
                    start to finish.</p>
            </div>

            <div class="hs-card">
                <div class="hs-icon">
                    <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                </div>
                <h4>Property Searches</h4>
                <p>Thorough searches on landed properties to verify title, identify encumbrances and protect your real
                    estate investment.</p>
            </div>

            <div class="hs-card">
                <div class="hs-icon">
                    <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                </div>
                <h4>Company &amp; Business Searches</h4>
                <p>Due diligence searches on companies and business names to support informed corporate
                    decision-making.
                </p>

            </div>

            <div class="hs-card">
                <div class="hs-icon">
                    <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path d="M17 3a2.828 2.828 0 114 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                    </svg>
                </div>
                <h4>Contracts &amp; Agreements</h4>
                <p>Preparation and vetting of contracts and agreements with meticulous legal precision to keep your
                    dealings secure.</p>
            </div>

        </div>
        <div style="text-align:center;margin-top:48px;">
            <a href="services.php" class="btn-primary">View All Services</a>
        </div>
    </div>
</section>

<!-- LEGAL ARTICLES -->
<?php include 'includes/articles.php'; $home_articles = array_slice($articles, 0, 6); ?>
<section class="articles-section home-articles-section">
    <div class="container">
        <div class="section-header">
            <span class="section-label light">Legal Articles</span>
            <h2>Insights From Our <em>Legal Team</em></h2>
            <p>Practical, easy-to-read publications on evolving areas of Nigerian law — free to read and download.</p>
        </div>
        <div class="articles-grid">
            <?php foreach ($home_articles as $a): ?>
                <article class="article-card">
                    <div class="article-icon">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="9" y1="13" x2="15" y2="13"/>
                            <line x1="9" y1="17" x2="15" y2="17"/>
                        </svg>
                    </div>
                    <span class="article-cat"><?php echo htmlspecialchars($a['category']); ?></span>
                    <h4><?php echo htmlspecialchars($a['title']); ?></h4>
                    <div class="article-actions">
                        <a href="articles/<?php echo rawurlencode($a['file']); ?>" target="_blank" rel="noopener" class="article-link">
                            Read
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                        </a>
                        <a href="articles/<?php echo rawurlencode($a['file']); ?>" download class="article-download" aria-label="Download PDF">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <div style="text-align:center;margin-top:48px;">
            <a href="articles.php" class="btn-primary">View All Articles</a>
        </div>
    </div>
</section>

<!-- TEAM SECTION -->
<section class="home-team-section">
    <div class="container">
        <div class="section-header">
            <span class="section-label">Our Team</span>
            <h2>The People Behind<br /><em>Wholesome Legal House</em></h2>
            <p>Our qualified solicitors and associates bring decades of combined experience in litigation, corporate
                practice, property law and more.</p>
        </div>
        <div class="home-team-grid">

            <!-- Adebisi Ilori -->
            <div class="ht-card" tabindex="0" role="button" aria-label="View profile of Adebisi Ilori"
                onclick="openTeamModal('adebisi')">
                <div class="ht-img-wrap">
                    <img src="https://wholesomelegal.com/b/wp-content/uploads/2021/05/Adebisi-Ilori-scaled.jpg"
                        alt="Adebisi Ilori" />
                    <div class="ht-overlay">
                        <span class="ht-view-btn">View Profile</span>
                    </div>
                </div>
                <div class="ht-info">
                    <h4>Adebisi Ilori</h4>
                    <span class="ht-role">Managing Solicitor &amp; Senior Counsel</span>
                </div>
            </div>

            <!-- Onoja Joy -->
            <div class="ht-card" tabindex="0" role="button" aria-label="View profile of Onoja Joy"
                onclick="openTeamModal('joy')">
                <div class="ht-img-wrap">
                    <img src="https://wholesomelegal.com/b/wp-content/uploads/2021/05/Joy-Onoja-scaled.jpg"
                        alt="Onoja Joy" />
                    <div class="ht-overlay">
                        <span class="ht-view-btn">View Profile</span>
                    </div>
                </div>
                <div class="ht-info">
                    <h4>Onoja Joy</h4>
                    <span class="ht-role">Associate</span>
                </div>
            </div>

            <!-- Ibrahim Baba -->
            <div class="ht-card" tabindex="0" role="button" aria-label="View profile of Ibrahim Baba"
                onclick="openTeamModal('ibrahim')">
                <div class="ht-img-wrap">
                    <img src="https://wholesomelegal.com/b/wp-content/uploads/2021/05/Ibrahim-Baba-scaled.jpg"
                        alt="Ibrahim Baba" />
                    <div class="ht-overlay">
                        <span class="ht-view-btn">View Profile</span>
                    </div>
                </div>
                <div class="ht-info">
                    <h4>Ibrahim Baba</h4>
                    <span class="ht-role">Associate</span>
                </div>
            </div>

        </div>
        <div style="text-align:center;margin-top:40px;">
            <a href="team.php" class="btn-primary">Meet the Full Team</a>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials-section" id="testimonials">
    <div class="container">
        <div class="testi-header-row">
            <div class="section-header testi-header-left">
                <span class="section-label light">Testimonials</span>
                <h2>What People Say About Us</h2>
                <p class="testi-tagline"><em>"Professionalism, Quality, Value"</em></p>
            </div>
            <div class="testi-header-arrows">
                <button type="button" class="testi-arrow testi-prev" aria-label="Previous testimonial">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6" />
                    </svg>
                </button>
                <button type="button" class="testi-arrow testi-next" aria-label="Next testimonial">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="testi-slider" id="testiSlider">
            <!-- Side arrows: visible on desktop, hidden on mobile via CSS -->
            <button type="button" class="testi-arrow testi-prev" aria-label="Previous testimonial">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </button>
            <button type="button" class="testi-arrow testi-next" aria-label="Next testimonial">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
            </button>
            <div class="testi-track-wrap">
                <div class="testi-track">
                    <?php foreach ($testimonials as $t):
              $img = !empty($t['image']) ? htmlspecialchars($t['image']) : 'Images/Testimonial-1.png';
            ?>
                    <div class="testi-slide">
                        <div class="testi-card">
                            <div class="testi-quote">&ldquo;</div>
                            <p><?php echo nl2br(htmlspecialchars($t['message'])); ?></p>
                            <div class="testi-author">
                                <img src="<?php echo $img; ?>" alt="<?php echo htmlspecialchars($t['author_name']); ?>"
                                    onerror="this.src='Images/Testimonial-1.png'" />
                                <div>
                                    <strong><?php echo htmlspecialchars($t['author_name']); ?></strong>
                                    <span><?php echo htmlspecialchars($t['author_role'] ?: 'Client'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="testi-dots" id="testiDots"></div>
        </div>
    </div>
</section>

<script>
(function() {
    const slider = document.getElementById('testiSlider');
    if (!slider) return;
    const track = slider.querySelector('.testi-track');
    const slides = slider.querySelectorAll('.testi-slide');
    const dots = slider.querySelector('#testiDots');
    // Collect ALL prev/next buttons: side arrows (inside slider) + header arrows
    const prevBtns = document.querySelectorAll('.testi-prev');
    const nextBtns = document.querySelectorAll('.testi-next');
    let idx = 0,
        timer = null;

    function isMobile() {
        return window.innerWidth <= 768;
    }

    function perView() {
        if (isMobile()) return 1;
        if (window.innerWidth <= 1024) return 2;
        return 3;
    }

    function slideWidth() {
        // On mobile, slide is 88% of track-wrap width; on desktop use perView fraction
        if (isMobile()) return 88;
        return 100 / perView();
    }

    function maxIdx() {
        return Math.max(0, slides.length - perView());
    }

    function buildDots() {
        dots.innerHTML = '';
        const pages = maxIdx() + 1;
        for (let i = 0; i < pages; i++) {
            const b = document.createElement('button');
            b.className = 'testi-dot' + (i === 0 ? ' active' : '');
            b.setAttribute('aria-label', 'Go to slide ' + (i + 1));
            b.addEventListener('click', () => {
                idx = i;
                render();
            });
            dots.appendChild(b);
        }
    }

    function render() {
        idx = Math.min(idx, maxIdx());
        const w = slideWidth();
        slides.forEach(s => s.style.flex = '0 0 ' + w + '%');
        track.style.transform = 'translateX(-' + (idx * w) + '%)';
        dots.querySelectorAll('.testi-dot').forEach((d, i) => d.classList.toggle('active', i === idx));
    }

    function go(d) {
        idx = (idx + d + maxIdx() + 1) % (maxIdx() + 1);
        render();
    }

    function autoplay() {
        clearInterval(timer);
        timer = setInterval(() => go(1), 6000);
    }

    prevBtns.forEach(btn => btn.addEventListener('click', () => {
        go(-1);
        autoplay();
    }));
    nextBtns.forEach(btn => btn.addEventListener('click', () => {
        go(1);
        autoplay();
    }));

    slider.addEventListener('mouseenter', () => clearInterval(timer));
    slider.addEventListener('mouseleave', autoplay);

    window.addEventListener('resize', () => {
        buildDots();
        render();
    });

    // Touch/swipe support
    let startX = null,
        startY = null;
    track.addEventListener('touchstart', e => {
        startX = e.touches[0].clientX;
        startY = e.touches[0].clientY;
    }, {
        passive: true
    });
    track.addEventListener('touchmove', e => {
        if (startX === null) return;
        const dx = Math.abs(e.touches[0].clientX - startX);
        const dy = Math.abs(e.touches[0].clientY - startY);
        // If clearly horizontal swipe, prevent page scroll
        if (dx > dy && dx > 10) e.preventDefault();
    }, {
        passive: false
    });
    track.addEventListener('touchend', e => {
        if (startX === null) return;
        const dx = e.changedTouches[0].clientX - startX;
        if (Math.abs(dx) > 40) go(dx < 0 ? 1 : -1);
        startX = null;
        startY = null;
        autoplay();
    });

    // Mouse drag support (works in browser DevTools mobile mode too)
    let mouseStartX = null,
        isDragging = false;
    track.style.cursor = 'grab';
    track.addEventListener('mousedown', e => {
        mouseStartX = e.clientX;
        isDragging = false;
        track.style.cursor = 'grabbing';
        clearInterval(timer);
        e.preventDefault();
    });
    window.addEventListener('mousemove', e => {
        if (mouseStartX === null) return;
        if (Math.abs(e.clientX - mouseStartX) > 5) isDragging = true;
    });
    window.addEventListener('mouseup', e => {
        if (mouseStartX === null) return;
        const dx = e.clientX - mouseStartX;
        if (isDragging && Math.abs(dx) > 40) go(dx < 0 ? 1 : -1);
        mouseStartX = null;
        isDragging = false;
        track.style.cursor = 'grab';
        autoplay();
    });

    buildDots();
    render();
    autoplay();
})();
</script>

<!-- TEAM MODAL -->
<div class="team-modal-overlay" id="teamModalOverlay" onclick="closeTeamModal()">
    <div class="team-modal" id="teamModal" onclick="event.stopPropagation()">
        <button class="team-modal-close" onclick="closeTeamModal()" aria-label="Close">&times;</button>
        <div class="team-modal-inner" id="teamModalContent"></div>
    </div>
</div>

<script>
const teamData = {
    adebisi: {
        name: 'Adebisi Ilori',
        role: 'Managing Solicitor &amp; Senior Counsel',
        img: 'https://wholesomelegal.com/b/wp-content/uploads/2021/05/Adebisi-Ilori-scaled.jpg',
        email: 'bisi@wholesomelegal.com',
        phone: '+234 805 517 3900',
        specialisms: ['Corporate Law', 'Litigation', 'Private Practice'],
        bio: `Mr. Adebisi Ilori graduated from the Obafemi Awolowo University, Ile-Ife in 1992 and The Nigerian Law School in 1993. Before founding Wholesome Legal House in 2004, he served in the following capacities:<br><br>
        <ul class="modal-career">
          <li><span>1993–1994</span> Legal Adviser, Gumel Local Government, Jigawa State</li>
          <li><span>1994–1995</span> Junior Counsel, Omotayo Buraimoh &amp; Co.</li>
          <li><span>1995–2002</span> Senior Counsel &amp; Head of Chambers, Dele Olaniyan &amp; Co.</li>
          <li><span>2002–2004</span> Managing Solicitor (Kano Office), Bola Olotu &amp; Co.</li>
        </ul><br>
        Mr. Ilori brings a wealth of experience in corporate and private practice, delivering solutions that leave clients satisfied and at peace of mind.`
    },
    joy: {
        name: 'Onoja Joy',
        role: 'Associate',
        img: 'https://wholesomelegal.com/b/wp-content/uploads/2021/05/Joy-Onoja-scaled.jpg',
        email: 'joy_onoja@wholesomelegal.com',
        phone: '+234 817 924 2451',
        specialisms: ['Litigation', 'Property Law', 'Corporate Practice'],
        bio: `Joy Onoja is an Associate at Wholesome Legal House. She is a graduate of the University of Jos, where she obtained her Bachelor of Laws (LL.B), before proceeding to the Nigerian Law School, Lagos Campus, where she obtained her Barrister at Law (B.L).<br><br>
        Prior to joining Wholesome Legal House, Joy had garnered considerable professional experience in real estate, litigation and corporate practice whilst working in various law firms across Nigeria.<br><br>
        She has a special interest in Litigation, Property Law, and Corporate Practice.`
    },
    ibrahim: {
        name: 'Ibrahim Baba',
        role: 'Associate',
        img: 'https://wholesomelegal.com/b/wp-content/uploads/2021/05/Ibrahim-Baba-scaled.jpg',
        email: 'ibrahim_baba@wholesomelegal.com',
        phone: '+234 803 568 5277',
        specialisms: ['Litigation & Dispute Resolution', 'Data Protection', 'Intellectual Property',
            'Consumer & Competition'
        ],
        bio: `Ibrahim Baba graduated with a Second Class Upper from Bayero University, Kano and attended the Nigerian Law School, Lagos Campus, where he was called to the Nigerian Bar in 2017.<br><br>
        His practice areas cover Litigation &amp; Dispute Resolution, Privacy &amp; Data Protection, Intellectual Property, and Consumer and Competition law — bringing a modern, multi-disciplinary approach to the firm's legal services.`
    }
};

function openTeamModal(key) {
    const m = teamData[key];
    if (!m) return;
    const specialismHtml = m.specialisms.map(s => `<span class="modal-tag">${s}</span>`).join('');
    document.getElementById('teamModalContent').innerHTML = `
      <div class="modal-top">
        <img src="${m.img}" alt="${m.name}" class="modal-photo" />
        <div class="modal-head">
          <h3>${m.name}</h3>
          <p class="modal-role">${m.role}</p>
          <div class="modal-tags">${specialismHtml}</div>
          <div class="modal-contact">
            <a href="mailto:${m.email}"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg> ${m.email}</a>
            <a href="tel:${m.phone}"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.7A2 2 0 012 0h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14h0v2.92z"/></svg> ${m.phone}</a>
          </div>
        </div>
      </div>
      <div class="modal-bio">${m.bio}</div>
    `;
    document.getElementById('teamModalOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeTeamModal() {
    document.getElementById('teamModalOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

// keyboard close
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeTeamModal();
});
// keyboard activate cards
document.querySelectorAll('.ht-card').forEach(card => {
    card.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            card.click();
        }
    });
});
</script>

<?php $conn->close(); include 'includes/footer.php'; ?>