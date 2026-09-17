<?php
$pageTitle = 'Home';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<section class="hero" id="home">
    <div class="container hero-grid">
        <div class="hero-copy">
            <div class="eyebrow">HTML &middot; CSS &middot; JavaScript &middot; PHP</div>
            <h1>I design, break, and rebuild the web &mdash; <span class="accent">one project at a time.</span></h1>
            <p>
                I'm Francis, a web developer who works across the whole stack &mdash; from the buttons
                you click to the database that remembers what you clicked. I build with HTML, CSS,
                JavaScript, and PHP, and I care as much about the way a page loads as the way it looks.
                I'm not chasing perfection for its own sake &mdash; I'm chasing the small, real wins: a
                contact form that finally sends mail, a layout that survives every screen size, a client
                who stops asking &ldquo;can it look less generic?&rdquo; because it already doesn't.
            </p>
            <div class="hero-actions">
                <a href="#work" class="btn btn-primary">View my work</a>
                <a href="#contact" class="btn btn-ghost">Let's talk</a>
            </div>
            <div class="hero-tags">
                <span>Frontend</span>
                <span>Backend</span>
                <span>MySQL</span>
                <span>Debugging</span>
                <span>Intermediate &middot; always learning</span>
            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-blob">
                <div class="blob-ring"></div>
                <div class="blob-shape">
                    <img src="images/profile.jpg" alt="Francis, web developer">
                </div>
                <span class="ember"></span>
                <span class="ember"></span>
                <span class="ember"></span>
            </div>
        </div>
    </div>

    <div class="scroll-cue">
        <span>Scroll</span>
        <span class="line"></span>
    </div>
</section>

<!-- Molten seam divider -->
<div class="seam">
    <svg viewBox="0 0 1440 64" preserveAspectRatio="none">
        <defs>
            <linearGradient id="seamGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" stop-color="#8f1c14" stop-opacity="0" />
                <stop offset="15%" stop-color="#e8402c" />
                <stop offset="50%" stop-color="#ff6b45" />
                <stop offset="85%" stop-color="#e8402c" />
                <stop offset="100%" stop-color="#8f1c14" stop-opacity="0" />
            </linearGradient>
        </defs>
        <path id="seamPath1" d="M0,32 C220,-10 380,74 620,30 C860,-12 1040,70 1440,28"></path>
        <circle class="seam-dot" r="3.5"
            style="offset-path:path('M0,32 C220,-10 380,74 620,30 C860,-12 1040,70 1440,28')"></circle>
    </svg>
</div>

<!-- ======================= ABOUT / INTRO ======================= -->
<section class="about" id="about">
    <div class="container about-grid">

        <div class="about-figure reveal">
            <div class="about-blob">
                <img src="images/profile.jpg" alt="Francis at work">
            </div>
            <div class="tag-float">
                <b>Intermediate</b>
                still learning, still shipping
            </div>
        </div>

        <div class="about-copy">
            <div class="eyebrow">// About</div>
            <h2 class="reveal"
                style="font-family:var(--font-display); font-size:clamp(1.9rem,4vw,2.6rem); font-weight:600; margin-bottom:28px; line-height:1.2;">
                The developer behind the code
            </h2>

            <p class="reveal">
                I'm a self-taught, <strong>intermediate-level web developer</strong> who works comfortably
                across the front end and the back end. My toolkit is HTML, CSS, and JavaScript for
                everything a visitor sees and touches, and PHP with MySQL for everything that happens
                quietly behind the scenes &mdash; sessions, forms, databases, and the logic that holds a
                site together after the design is done.
            </p>

            <p class="reveal">
                Most of my projects start the same way: a client with a real business and no website
                that reflects it. I've built for a farm brand that needed a digital presence as
                trustworthy as its produce, a law firm that needed a site serious enough for its clients,
                pharmacy and pharmaceutical brands juggling prescriptions and inventory, and a consulting
                firm that needed its services explained clearly to people who'd never met them in person.
                Every project pushes me to solve a problem I hadn't solved before &mdash; a broken contact
                form, a login system, an admin dashboard, a database schema that actually makes sense.
            </p>

            <p class="reveal">
                I do most of my building locally with a <strong>WAMP stack</strong> before anything goes
                near a live server, which means I spend a lot of time in phpMyAdmin, dev tools, and the
                browser console chasing down the reason something isn't rendering the way it should. I'd
                call myself intermediate rather than expert &mdash; I'm still deep in the stage of learning
                where every project teaches you something you didn't know you didn't know &mdash; but I
                show up, I debug patiently, and I don't ship a site until it actually works, not just
                looks like it does.
            </p>

            <p class="reveal">
                Below is a closer look at what I work with, the kind of projects I've shipped, and how to
                reach me if you've got something that needs building.
            </p>
        </div>

    </div>
</section>

<div class="seam">
    <svg viewBox="0 0 1440 64" preserveAspectRatio="none">
        <path d="M0,26 C260,66 420,-8 700,30 C980,68 1180,4 1440,32"></path>
        <circle class="seam-dot" r="3.5" style="offset-path:path('M0,26 C260,66 420,-8 700,30 C980,68 1180,4 1440,32')">
        </circle>
    </svg>
</div>

<!-- ======================= SKILLS ======================= -->
<section class="skills" id="skills">
    <div class="container">
        <div class="section-head reveal">
            <div class="eyebrow">// Skills</div>
            <h2>What I build with</h2>
            <p>The stack I reach for on every project, split by what runs in the browser and what runs behind it.</p>
        </div>

        <div class="skill-tabs reveal">
            <button class="skill-tab active" data-target="panel-frontend">Frontend</button>
            <button class="skill-tab" data-target="panel-backend">Backend</button>
            <button class="skill-tab" data-target="panel-tools">Tools &amp; Workflow</button>
        </div>

        <div class="skill-panel active" id="panel-frontend">
            <div class="skill-card reveal">
                <h3>HTML5</h3>
                <p>Semantic, accessible markup as the base of every page I build.</p>
                <div class="pips"><span class="filled"></span><span class="filled"></span><span
                        class="filled"></span><span class="filled"></span><span></span></div>
            </div>
            <div class="skill-card reveal">
                <h3>CSS3</h3>
                <p>Flexbox, Grid, animation and responsive layouts, no framework required.</p>
                <div class="pips"><span class="filled"></span><span class="filled"></span><span
                        class="filled"></span><span class="filled"></span><span></span></div>
            </div>
            <div class="skill-card reveal">
                <h3>JavaScript</h3>
                <p>DOM interaction, form validation, and the small details that make a page feel alive.</p>
                <div class="pips"><span class="filled"></span><span class="filled"></span><span
                        class="filled"></span><span></span><span></span></div>
            </div>
        </div>

        <div class="skill-panel" id="panel-backend">
            <div class="skill-card reveal">
                <h3>PHP</h3>
                <p>Server-side logic, includes, sessions, and form handling that actually works.</p>
                <div class="pips"><span class="filled"></span><span class="filled"></span><span
                        class="filled"></span><span class="filled"></span><span></span></div>
            </div>
            <div class="skill-card reveal">
                <h3>MySQL</h3>
                <p>Schema design, PDO prepared statements, and querying data safely.</p>
                <div class="pips"><span class="filled"></span><span class="filled"></span><span
                        class="filled"></span><span></span><span></span></div>
            </div>
            <div class="skill-card reveal">
                <h3>Auth &amp; Sessions</h3>
                <p>Login systems, bcrypt hashing, and session-based access control.</p>
                <div class="pips"><span class="filled"></span><span class="filled"></span><span
                        class="filled"></span><span></span><span></span></div>
            </div>
        </div>

        <div class="skill-panel" id="panel-tools">
            <div class="skill-card reveal">
                <h3>Git &amp; GitHub</h3>
                <p>Version control for every project, from the first commit onward.</p>
                <div class="pips"><span class="filled"></span><span class="filled"></span><span
                        class="filled"></span><span></span><span></span></div>
            </div>
            <div class="skill-card reveal">
                <h3>WAMP &amp; phpMyAdmin</h3>
                <p>My local development environment for building and testing before anything goes live.</p>
                <div class="pips"><span class="filled"></span><span class="filled"></span><span
                        class="filled"></span><span class="filled"></span><span></span></div>
            </div>
            <div class="skill-card reveal">
                <h3>PHPMailer &amp; SMTP</h3>
                <p>Wiring up contact forms so messages actually land in an inbox.</p>
                <div class="pips"><span class="filled"></span><span
                        class="filled"></span><span></span><span></span><span></span></div>
            </div>
        </div>
    </div>
</section>

<div class="seam">
    <svg viewBox="0 0 1440 64" preserveAspectRatio="none">
        <path d="M0,34 C240,-6 460,72 720,28 C980,-10 1200,66 1440,30"></path>
        <circle class="seam-dot" r="3.5"
            style="offset-path:path('M0,34 C240,-6 460,72 720,28 C980,-10 1200,66 1440,30')"></circle>
    </svg>
</div>

<!-- ======================= FEATURED WORKS ======================= -->
<section class="work" id="work">
    <div class="container">
        <div class="section-head reveal">
            <div class="eyebrow">// Featured Work</div>
            <h2>Recent projects</h2>
            <p>A handful of client sites built end to end &mdash; design, front end, and the PHP/MySQL running
                underneath.</p>
        </div>

        <div class="work-grid">

            <a href="projects/Alira%20Farm%20-%20Multi-Page/index.php" target="_blank" rel="noopener noreferrer"
                class="work-card span-4 reveal">
                <img src="images/work/alira-farm.jpeg" alt="Alira Farm website screenshot">
                <div class="work-body">
                    <span class="work-tag">Agriculture</span>
                    <h3>Alira Farm</h3>
                    <p>Grew from a single landing page into a full six-section, multi-page site with custom photo
                        layouts and a contact form wired to MySQL.</p>
                    <div class="work-stack"><span>HTML</span><span>CSS</span><span>PHP</span><span>MySQL</span></div>
                </div>
            </a>

            <a href="projects/GREEN-CROSS-2/index.html" target="_blank" rel="noopener noreferrer"
                class="work-card span-2 reveal">
                <img src="images/work/green-cross.jpg" alt="Green Cross Pharmacy screenshot">
                <div class="work-body">
                    <span class="work-tag">Pharmacy</span>
                    <h3>Green Cross Pharmacy</h3>
                    <p>Rebuilt from a broken template &mdash; fixed contact routing, repaired the mail system, restyled
                        around green &amp; gold.</p>
                    <div class="work-stack"><span>PHP</span><span>PHPMailer</span></div>
                </div>
            </a>

            <a href="projects/Hemjirika%27s%20Pharmacueticals/index.php" target="_blank" rel="noopener noreferrer"
                class="work-card span-2 reveal">
                <img src="images/work/hemjirika.jpg" alt="Hemjirika's Pharmaceuticals screenshot">
                <div class="work-body">
                    <span class="work-tag">Pharmaceutical</span>
                    <h3>Hemjirika's Pharmaceuticals</h3>
                    <p>Built from scratch with prescription uploads, compliance pages, and a blog journal on a shared
                        data layer.</p>
                    <div class="work-stack"><span>PHP</span><span>MySQL</span><span>JS</span></div>
                </div>
            </a>

            <a href="projects/borderless/index.php" target="_blank" rel="noopener noreferrer"
                class="work-card span-4 reveal">
                <img src="images/work/borderless.jpg" alt="Borderless Analysts screenshot">
                <div class="work-body">
                    <span class="work-tag">Consulting</span>
                    <h3>Borderless Analysts</h3>
                    <p>A ten-page consulting site translating AI-automation services into copy people without a
                        technical background could actually follow.</p>
                    <div class="work-stack"><span>PHP</span><span>HTML</span><span>CSS</span><span>JS</span></div>
                </div>
            </a>

            <a href="projects/wholesome_project/index.php" target="_blank" rel="noopener noreferrer"
                class="work-card span-6 reveal">
                <img src="images/work/wholesome-legal.jpg" alt="Wholesome Legal House screenshot">
                <div class="work-body">
                    <span class="work-tag">Legal</span>
                    <h3>Wholesome Legal House</h3>
                    <p>An ongoing law-firm platform with a full blog CMS, a testimonial approval workflow, and an admin
                        panel to manage all of it.</p>
                    <div class="work-stack"><span>PHP</span><span>MySQL</span><span>Admin CMS</span></div>
                </div>
            </a>

        </div>

        <div class="work-more reveal">
            <a href="projects.php" class="btn btn-ghost">See all projects</a>
        </div>
    </div>
</section>

<div class="seam">
    <svg viewBox="0 0 1440 64" preserveAspectRatio="none">
        <path d="M0,30 C220,68 480,-8 760,32 C1020,70 1220,6 1440,26"></path>
        <circle class="seam-dot" r="3.5"
            style="offset-path:path('M0,30 C220,68 480,-8 760,32 C1020,70 1220,6 1440,26')"></circle>
    </svg>
</div>

<!-- ======================= SERVICES ======================= -->
<section class="services" id="services">
    <div class="container">
        <div class="section-head reveal">
            <div class="eyebrow">// Services</div>
            <h2>How I can help</h2>
            <p>Whether you need a full site from scratch or a fix on something that already exists, here's where I come
                in.</p>
        </div>

        <div class="services-grid">
            <div class="service-card reveal">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 5h18v14H3zM3 9h18M8 5v4" />
                    </svg>
                </div>
                <h3>Website Development</h3>
                <p>Full websites built from scratch with HTML, CSS, JavaScript, and PHP &mdash; from the first wireframe
                    to a site that's live and working.</p>
            </div>

            <div class="service-card reveal">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <ellipse cx="12" cy="5" rx="8" ry="3" />
                        <path d="M4 5v14c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 12c0 1.7 3.6 3 8 3s8-1.3 8-3" />
                    </svg>
                </div>
                <h3>Backend &amp; Database</h3>
                <p>PHP and MySQL systems underneath the design: contact forms that deliver, admin logins, dashboards,
                    and data stored the right way.</p>
            </div>

            <div class="service-card reveal">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2l2.5 5 5.5.7-4 3.9 1 5.5L12 14.6 6.9 17.1l1-5.5-4-3.9L9.5 7z" />
                    </svg>
                </div>
                <h3>Site Debugging &amp; Fixes</h3>
                <p>Broken contact forms, layout bugs, login issues &mdash; I go in, find what's actually wrong, and fix
                    it without rebuilding what already works.</p>
            </div>

            <div class="service-card reveal">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3" />
                        <path
                            d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.9.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.9-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.9V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z" />
                    </svg>
                </div>
                <h3>Ongoing Maintenance</h3>
                <p>Updates, new pages, styling changes, and small fixes as your site grows, so it doesn't go stale the
                    month after launch.</p>
            </div>
        </div>
    </div>
</section>

<div class="seam">
    <svg viewBox="0 0 1440 64" preserveAspectRatio="none">
        <path d="M0,28 C260,-8 500,70 780,26 C1040,-10 1240,68 1440,32"></path>
        <circle class="seam-dot" r="3.5"
            style="offset-path:path('M0,28 C260,-8 500,70 780,26 C1040,-10 1240,68 1440,32')"></circle>
    </svg>
</div>

<!-- ======================= CONTACT ======================= -->
<section class="contact" id="contact">
    <div class="container contact-grid">

        <div class="contact-info reveal">
            <div class="eyebrow">// Contact</div>
            <h2>Got something that needs building?</h2>
            <p>
                Whether it's a full site from scratch or a bug that's been driving you up the wall,
                I'd like to hear about it. Fill in the form or reach me directly &mdash; I usually
                reply within a day.
            </p>

            <ul class="contact-list">
                <li>
                    <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1zM3.5 6.5l8.5 6 8.5-6" />
                        </svg></span>
                    hello@fhdev.com
                </li>
                <li>
                    <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 1 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg></span>
                    Based in Nigeria &middot; working with clients everywhere
                </li>
                <li>
                    <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 7v5l3 3" />
                        </svg></span>
                    Usually replies within 24 hours
                </li>
            </ul>

            <div class="social-row">
                <a href="#" aria-label="GitHub">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M9 19c-4.3 1.4-4.3-2.5-6-3m12 5v-3.5c0-1 .1-1.4-.5-2 2.8-.3 5.5-1.4 5.5-6a4.6 4.6 0 0 0-1.3-3.2 4.2 4.2 0 0 0-.1-3.2s-1.1-.3-3.5 1.3a12.3 12.3 0 0 0-6.2 0C6.5 2.8 5.4 3.1 5.4 3.1a4.2 4.2 0 0 0-.1 3.2A4.6 4.6 0 0 0 4 9.5c0 4.6 2.7 5.7 5.5 6-.6.6-.6 1.2-.5 2V21" />
                    </svg>
                </a>
                <a href="#" aria-label="LinkedIn">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M6 9H2v13h4V9zM4 6a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM22 22v-7.5c0-3-1.6-4.5-4-4.5-1.8 0-2.8 1-3.3 2V10H10v12h4.7v-6.7c0-1.3.9-2.3 2.2-2.3 1.3 0 2.1 1 2.1 2.3V22H22z" />
                    </svg>
                </a>
                <a href="#" aria-label="Twitter / X">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M4 4l16 16M20 4L4 20" />
                    </svg>
                </a>
            </div>
        </div>

        <form class="contact-form reveal" action="contact.php" method="POST">
            <div class="form-row">
                <div class="field">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your full name" required>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@email.com" required>
                </div>
            </div>

            <div class="field">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" placeholder="What's this about?" required>
            </div>

            <div class="field">
                <label for="message">Message</label>
                <textarea id="message" name="message" placeholder="Tell me a bit about the project..."
                    required></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Send message</button>
        </form>

    </div>
</section>

<?php include 'includes/footer.php'; ?>