<?php
$contact_email = "info@alirafarm.ng";
$contact_phone = "+234 000 000 0000";
$contact_location = "Nigeria";

$is_home = true;
$page_title = "ALIRA Farm — Integrated Poultry Agribusiness";
$page_description = "ALIRA Farm is an integrated poultry agribusiness building Nigeria's leading farm-to-fork poultry brand.";
require 'includes/header.php';
?>

    <!-- ============ HERO ============ -->
    <section class="hero">
        <div class="hero-field" aria-hidden="true">
            <svg viewBox="0 0 1600 500" preserveAspectRatio="none" class="furrow-svg">
                <path class="furrow" d="M-100 460 C 300 380, 500 380, 1700 460" />
                <path class="furrow" d="M-100 400 C 300 320, 500 320, 1700 400" />
                <path class="furrow" d="M-100 340 C 300 260, 500 260, 1700 340" />
                <path class="furrow" d="M-100 280 C 300 200, 500 200, 1700 280" />
            </svg>
        </div>

        <div class="hero-inner">
            <p class="eyebrow reveal">Corporate Profile · Est. Nigeria</p>
            <h1 class="hero-title reveal">
                Building Nigeria's <em>farm‑to‑fork</em><br> poultry powerhouse.
            </h1>
            <p class="hero-lede reveal">
                ALIRA Farm is a vertically integrated poultry agribusiness spanning feed
                production, hatchery operations, broiler &amp; layer farming, processing
                and cold‑chain distribution — built to help close Nigeria's protein
                deficit at scale.
            </p>
            <div class="hero-actions reveal">
                <a href="#about" class="btn btn-primary">Explore the Farm</a>
                <a href="#contact" class="btn btn-ghost">Partner With Us</a>
            </div>

            <div class="orbit-cluster reveal" style="margin-top:46px;">
                <div class="photo-orbit">
                    <img src="images/img-11.jpeg" alt="ALIRA Farm poultry operations">
                    <svg class="orbit-ring" viewBox="0 0 220 220" aria-hidden="true">
                        <circle cx="110" cy="110" r="104" />
                    </svg>
                </div>
                <div class="photo-orbit is-small spin-reverse">
                    <img src="images/img-2.jpeg" alt="ALIRA Farm produce">
                    <svg class="orbit-ring" viewBox="0 0 220 220" aria-hidden="true">
                        <circle cx="110" cy="110" r="104" />
                    </svg>
                </div>
                <div class="photo-orbit is-small">
                    <img src="images/img-8.jpeg" alt="ALIRA Farm poultry house">
                    <svg class="orbit-ring" viewBox="0 0 220 220" aria-hidden="true">
                        <circle cx="110" cy="110" r="104" />
                    </svg>
                </div>
            </div>

            <div class="hero-chickline reveal" aria-hidden="true">
                <svg viewBox="0 0 120 90" class="hen-svg">
                    <path
                        d="M20 62 C10 62 6 52 12 44 C8 36 16 28 26 30 C28 20 40 14 50 20 C58 12 72 14 76 24 C86 24 92 34 86 42 C92 48 88 58 78 58 L78 66 L84 74 L74 66 L70 74 L68 66 C50 70 30 70 20 62 Z" />
                    <circle cx="70" cy="34" r="2.4" fill="var(--cream)" stroke="none" />
                    <path d="M84 30 L94 27 L86 36 Z" />
                    <path d="M50 12 C52 6 60 4 64 8 C68 4 76 6 74 12" />
                </svg>
            </div>

            <a href="#about" class="scroll-cue" aria-label="Scroll to content">
                <span></span>
            </a>
        </div>
    </section>

    <!-- ============ STAT STRIP ============ -->
    <section class="stat-strip">
        <div class="stat-strip-inner">
            <div class="stat reveal">
                <span class="stat-num" data-target="25" data-suffix="%">0%</span>
                <span class="stat-label">of Nigeria's agricultural GDP<br>comes from poultry</span>
            </div>
            <div class="stat-divider" aria-hidden="true"></div>
            <div class="stat reveal">
                <span class="stat-num" data-target="17000" data-suffix="">0</span>
                <span class="stat-label">commercial poultry farms<br>operating across Nigeria</span>
            </div>
            <div class="stat-divider" aria-hidden="true"></div>
            <div class="stat reveal">
                <span class="stat-num" data-target="45" data-suffix="M">0M</span>
                <span class="stat-label">chickens make up Nigeria's<br>national flock — still short of demand</span>
            </div>
        </div>
    </section>

    <!-- ============ ABOUT (preview) ============ -->
    <section class="section" id="about">
        <div class="section-inner about-grid">
            <div class="about-figure reveal">
                <div class="figure-frame">
                    <svg viewBox="0 0 300 360" class="wheat-svg" aria-hidden="true">
                        <g class="wheat-stalk">
                            <line x1="150" y1="360" x2="150" y2="60" />
                            <path d="M150 250 C130 240 120 220 150 205 C180 220 170 240 150 250Z" />
                            <path d="M150 220 C170 210 180 190 150 175 C120 190 130 210 150 220Z" />
                            <path d="M150 190 C130 180 120 160 150 145 C180 160 170 180 150 190Z" />
                            <path d="M150 160 C170 150 180 130 150 115 C120 130 130 150 150 160Z" />
                            <path d="M150 130 C130 120 120 100 150 85 C180 100 170 120 150 130Z" />
                            <path d="M150 100 C160 90 160 75 150 60 C140 75 140 90 150 100Z" />
                        </g>
                    </svg>
                </div>
            </div>

            <div class="about-copy">
                <p class="eyebrow reveal">About ALIRA Farm</p>
                <h2 class="section-title reveal">A complete value chain,<br>under one roof.</h2>
                <p class="lead-text reveal">
                    ALIRA Farm is a fully integrated poultry enterprise delivering
                    high‑quality poultry products to Nigerian households, businesses
                    and institutions — from breeder farms and hatcheries through to
                    processing and cold‑chain distribution.
                </p>

                <ul class="chain-pills reveal">
                    <li>Breeder Farms</li>
                    <li>Hatchery</li>
                    <li>Broiler Production</li>
                    <li>Layer Production</li>
                    <li>Feed Mill</li>
                    <li>Processing &amp; Abattoir</li>
                    <li>Cold‑Chain Distribution</li>
                </ul>

                <div class="section-more reveal">
                    <a href="about.php" class="btn-outline">Read the Full Story <span class="arrow">→</span></a>
                </div>
            </div>
        </div>

        <div class="section-inner">
            <div class="photo-collage reveal">
                <div class="collage-main">
                    <img src="images/img-1.jpeg" alt="ALIRA Farm broiler flock">
                </div>
                <div class="collage-side">
                    <div class="collage-chip">
                        <img src="images/img-12.jpeg" alt="ALIRA Farm feed detail">
                    </div>
                    <div class="collage-chip">
                        <img src="images/img-4.jpeg" alt="ALIRA Farm operations detail">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ VISION & MISSION (preview) ============ -->
    <section class="section section-dark" id="vision">
        <div class="section-inner">
            <p class="eyebrow eyebrow-light reveal">Where we're headed</p>
            <h2 class="section-title title-light reveal">Vision &amp; Mission</h2>

            <div class="vm-grid">
                <div class="vm-card reveal">
                    <span class="vm-tag">Vision</span>
                    <p>
                        To become Nigeria's leading integrated poultry brand — recognized
                        for excellence in quality, innovation and sustainability.
                    </p>
                </div>
                <div class="vm-card reveal">
                    <span class="vm-tag">Mission</span>
                    <p>
                        To build a self‑sustaining, technology‑driven poultry ecosystem
                        delivering affordable, high‑quality animal protein to Nigerians.
                    </p>
                </div>
            </div>

            <div class="orbit-cluster reveal" style="margin-top:50px;">
                <div class="photo-orbit is-small">
                    <img src="images/img-6.jpeg" alt="ALIRA Farm team at work">
                    <svg class="orbit-ring" viewBox="0 0 220 220" aria-hidden="true">
                        <circle cx="110" cy="110" r="104" />
                    </svg>
                </div>
                <div class="photo-orbit is-small spin-reverse">
                    <img src="images/img-13.jpeg" alt="ALIRA Farm poultry care">
                    <svg class="orbit-ring" viewBox="0 0 220 220" aria-hidden="true">
                        <circle cx="110" cy="110" r="104" />
                    </svg>
                </div>
                <p style="max-width:360px; font-size:14.5px; color:rgba(245,241,227,.7); margin:0;">
                    Vertical integration, sustainable practice, community out‑grower
                    training and constant innovation guide every decision we make.
                </p>
            </div>

            <div class="section-more reveal">
                <a href="vision-mission.php" class="btn-outline btn-outline-light">See Full Vision, Mission &amp; Pillars <span class="arrow">→</span></a>
            </div>
        </div>
    </section>

    <!-- ============ GOALS (preview) ============ -->
    <section class="section" id="goals">
        <div class="section-inner">
            <p class="eyebrow reveal">What we're building toward</p>
            <h2 class="section-title reveal">Goals &amp; Targets</h2>
            <p class="section-intro reveal">
                Five commitments anchor ALIRA Farm's growth — from production scale
                and feed self‑sufficiency to job creation and export readiness.
            </p>

            <div class="goals-grid reveal">
                <div class="goal-card">
                    <span class="goal-icon">🐣</span>
                    <h3>Production Scale</h3>
                    <span class="goal-target">1,000,000+ birds at full capacity</span>
                </div>
                <div class="goal-card">
                    <span class="goal-icon">🌾</span>
                    <h3>Feed Self‑Sufficiency</h3>
                    <span class="goal-target">Backward integration on maize &amp; soybean</span>
                </div>
                <div class="goal-card">
                    <span class="goal-icon">📍</span>
                    <h3>Market Penetration</h3>
                    <span class="goal-target">Retail, hospitality &amp; institutional supply</span>
                </div>
                <div class="goal-card">
                    <span class="goal-icon">🤝</span>
                    <h3>Job Creation</h3>
                    <span class="goal-target">500+ direct &amp; indirect jobs</span>
                </div>
                <div class="goal-card">
                    <span class="goal-icon">🌍</span>
                    <h3>Export Readiness</h3>
                    <span class="goal-target">Regional &amp; EU market standards</span>
                </div>
            </div>

            <div class="photo-grid reveal">
                <figure>
                    <img src="images/img-9.jpeg" alt="ALIRA Farm poultry house interior">
                    <figcaption>Production Floor</figcaption>
                </figure>
                <figure>
                    <img src="images/img-10.jpeg" alt="ALIRA Farm farmland">
                    <figcaption>Feed &amp; Farmland</figcaption>
                </figure>
            </div>

            <div class="section-more reveal">
                <a href="goals.php" class="btn-outline">View All Goals &amp; Objectives <span class="arrow">→</span></a>
            </div>
        </div>
    </section>

    <!-- ============ PRODUCTS & SERVICES (preview) ============ -->
    <section class="section section-tint" id="products">
        <div class="section-inner">
            <p class="eyebrow reveal">What we offer</p>
            <h2 class="section-title reveal">Products &amp; Services</h2>
            <p class="section-intro reveal">
                A full poultry product range, backed by feed supply, veterinary
                advisory and out‑grower support services.
            </p>

            <div class="card-grid reveal">
                <div class="flip-card">
                    <div class="flip-inner">
                        <div class="flip-front"><span>🐥</span>
                            <h4>Day‑Old Chicks</h4>
                        </div>
                        <div class="flip-back">
                            <p>Broiler and layer day‑old chicks from quality parent stock.</p>
                        </div>
                    </div>
                </div>
                <div class="flip-card">
                    <div class="flip-inner">
                        <div class="flip-front"><span>🥚</span>
                            <h4>Table Eggs</h4>
                        </div>
                        <div class="flip-back">
                            <p>Premium fresh eggs for retail and institutional markets.</p>
                        </div>
                    </div>
                </div>
                <div class="flip-card">
                    <div class="flip-inner">
                        <div class="flip-front"><span>🍗</span>
                            <h4>Broiler Meat</h4>
                        </div>
                        <div class="flip-back">
                            <p>Fresh and frozen whole chickens and chicken parts.</p>
                        </div>
                    </div>
                </div>
                <div class="flip-card">
                    <div class="flip-inner">
                        <div class="flip-front"><span>🌭</span>
                            <h4>Value‑Added Products</h4>
                        </div>
                        <div class="flip-back">
                            <p>Processed chicken products — sausages, nuggets and more.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="photo-grid reveal">
                <figure>
                    <img src="images/img-14.jpeg" alt="ALIRA Farm table eggs">
                    <figcaption>Table Eggs</figcaption>
                </figure>
                <figure>
                    <img src="images/img-19.jpeg" alt="ALIRA Farm processed poultry">
                    <figcaption>Processing Line</figcaption>
                </figure>
                <figure>
                    <img src="images/img-7.jpeg" alt="ALIRA Farm cold-chain distribution">
                    <figcaption>Cold‑Chain Distribution</figcaption>
                </figure>
            </div>

            <div class="section-more reveal">
                <a href="products.php" class="btn-outline">View All Products &amp; Services <span class="arrow">→</span></a>
            </div>
        </div>
    </section>

    <!-- ============ CLIENTS (preview) ============ -->
    <section class="section section-dark" id="clients">
        <div class="section-inner">
            <p class="eyebrow eyebrow-light reveal">Who we serve</p>
            <h2 class="section-title title-light reveal">Target Clients &amp; Customers</h2>
            <p class="section-intro reveal" style="color:rgba(245,241,227,.72);">
                From households to export markets, six customer segments anchor
                ALIRA Farm's commercial strategy.
            </p>

            <div class="client-grid reveal">
                <div class="client-card"><h4>Retail Consumers</h4></div>
                <div class="client-card"><h4>Food Service</h4></div>
                <div class="client-card"><h4>Institutional Buyers</h4></div>
                <div class="client-card"><h4>Wholesalers &amp; Distributors</h4></div>
                <div class="client-card"><h4>Processors</h4></div>
                <div class="client-card"><h4>Export Markets</h4></div>
            </div>

            <figure class="banner-figure reveal">
                <img src="images/img-15.jpeg" alt="ALIRA Farm distribution to clients">
                <figcaption>Serving retailers, institutions and export markets across Nigeria</figcaption>
            </figure>

            <div class="section-more reveal">
                <a href="clients.php" class="btn-outline btn-outline-light">See All Client Segments <span class="arrow">→</span></a>
            </div>
        </div>
    </section>

    <!-- ============ ORGANIZATIONAL STRUCTURE (preview) ============ -->
    <section class="section" id="structure">
        <div class="section-inner">
            <p class="eyebrow reveal">How we're organized</p>
            <h2 class="section-title reveal">Organizational Structure</h2>
            <p class="section-intro reveal">
                ALIRA Farm adopts a functional organizational structure designed for
                operational efficiency, clear accountability and scalability.
            </p>

            <div class="photo-collage reveal">
                <div class="collage-main">
                    <img src="images/img-17.jpeg" alt="ALIRA Farm management on site">
                </div>
                <div class="collage-side">
                    <div style="border-left:2px dotted var(--line); padding-left:22px;">
                        <div class="org-node org-root" style="margin:0 0 20px;">Managing Director</div>
                        <p style="font-size:14.5px; color:rgba(27,29,16,.7);">
                            Three divisions — Production, Commercial &amp; Sales, and
                            Finance &amp; Admin — report directly to the Managing Director,
                            each led by dedicated functional managers.
                        </p>
                    </div>
                </div>
            </div>

            <div class="section-more reveal">
                <a href="structure.php" class="btn-outline">View Full Org Chart &amp; Management Team <span class="arrow">→</span></a>
            </div>
        </div>
    </section>

    <!-- ============ CONTACT ============ -->
    <section class="section section-dark contact-section" id="contact">
        <div class="section-inner contact-grid">
            <div class="contact-copy reveal">
                <p class="eyebrow eyebrow-light">Let's grow together</p>
                <h2 class="section-title title-light">Partner with ALIRA Farm</h2>
                <p>
                    Whether you're a retailer, distributor, institution or investor —
                    we'd love to hear from you. Reach out and our team will respond
                    promptly.
                </p>
                <div class="contact-details">
                    <div><span class="contact-label">Email</span><a
                            href="mailto:<?php echo htmlspecialchars($contact_email); ?>"><?php echo htmlspecialchars($contact_email); ?></a>
                    </div>
                    <div><span class="contact-label">Phone</span><a
                            href="tel:<?php echo preg_replace('/\s+/', '', $contact_phone); ?>"><?php echo htmlspecialchars($contact_phone); ?></a>
                    </div>
                    <div><span
                            class="contact-label">Location</span><span><?php echo htmlspecialchars($contact_location); ?></span>
                    </div>
                </div>
            </div>

            <form class="contact-form reveal" id="contactForm" method="post" action="#contact">
                <div class="form-row">
                    <label for="name">Full name</label>
                    <input type="text" id="name" name="name" required placeholder="Your name">
                </div>
                <div class="form-row">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" required placeholder="you@example.com">
                </div>
                <div class="form-row">
                    <label for="subject">I'm interested in</label>
                    <select id="subject" name="subject">
                        <option>Buying poultry products</option>
                        <option>Becoming a distributor</option>
                        <option>Out‑grower / farmer partnership</option>
                        <option>Investment enquiry</option>
                        <option>Something else</option>
                    </select>
                </div>
                <div class="form-row">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="4" required
                        placeholder="Tell us a little about what you need"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                <p class="form-note" id="formNote"></p>
            </form>
        </div>
    </section>

<?php require 'includes/footer.php'; ?>
