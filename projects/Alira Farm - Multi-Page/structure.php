<?php
$is_home = false;
$page_title = "Organizational Structure — ALIRA Farm";
$page_description = "ALIRA Farm's functional organizational structure, divisional breakdown and key management positions.";
require 'includes/header.php';
?>

    <!-- ============ PAGE HERO ============ -->
    <section class="page-hero">
        <div class="page-hero-inner">
            <p class="breadcrumb"><a href="index.php">Home</a> / Structure</p>
            <h1 class="page-hero-title">Built for accountability at scale.</h1>
            <p class="page-hero-lede">
                A functional structure spanning Production, Commercial &amp; Sales, and
                Finance &amp; Admin — with clear ownership at every level.
            </p>
        </div>
    </section>

    <!-- ============ ORGANIZATIONAL STRUCTURE — FULL ============ -->
    <section class="section" id="structure-full">
        <div class="section-inner">
            <p class="eyebrow reveal">How we're organized</p>
            <h2 class="section-title reveal">Organizational Structure</h2>
            <p class="section-intro reveal">
                ALIRA Farm adopts a functional organizational structure designed for
                operational efficiency, clear accountability and scalability.
            </p>

            <figure class="banner-figure reveal">
                <img src="images/img-17.jpeg" alt="ALIRA Farm management on site">
                <figcaption>Leadership present across every stage of production</figcaption>
            </figure>

            <div class="orgchart reveal" id="orgChart">
                <svg viewBox="0 0 1000 430" class="org-lines" aria-hidden="true">
                    <path class="org-path" d="M500 70 L500 110" />
                    <path class="org-path" d="M170 150 L830 150" />
                    <path class="org-path" d="M170 150 L170 190" />
                    <path class="org-path" d="M500 150 L500 190" />
                    <path class="org-path" d="M830 150 L830 190" />
                </svg>

                <div class="org-node org-root">Managing Director</div>

                <div class="org-row">
                    <div class="org-node org-branch">
                        <h4>Production Division</h4>
                        <ul>
                            <li>Breeder Farm</li>
                            <li>Hatchery</li>
                            <li>Broiler Farm</li>
                            <li>Layer Farm</li>
                            <li>Feed Mill</li>
                            <li>Processing Plant</li>
                            <li>Cold Chain</li>
                        </ul>
                    </div>
                    <div class="org-node org-branch">
                        <h4>Commercial &amp; Sales Division</h4>
                        <ul>
                            <li>Sales &amp; Marketing</li>
                            <li>Distribution</li>
                            <li>Customer Service</li>
                            <li>Export Operations</li>
                        </ul>
                    </div>
                    <div class="org-node org-branch">
                        <h4>Finance &amp; Admin Division</h4>
                        <ul>
                            <li>Accounts</li>
                            <li>Procurement</li>
                            <li>HR &amp; Admin</li>
                            <li>IT &amp; Systems</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mgmt-table reveal">
                <h3 class="sub-heading">Key Management Positions</h3>
                <div class="mgmt-grid">
                    <div class="mgmt-row"><span>Managing Director</span><span>Overall strategic leadership &amp; P&amp;L
                            accountability</span></div>
                    <div class="mgmt-row"><span>Production Manager</span><span>Oversee all farming and processing
                            operations</span></div>
                    <div class="mgmt-row"><span>Sales &amp; Marketing Manager</span><span>Drive revenue growth and brand
                            development</span></div>
                    <div class="mgmt-row"><span>Finance Manager</span><span>Financial planning, reporting and
                            control</span></div>
                    <div class="mgmt-row"><span>HR &amp; Admin Manager</span><span>Talent management and organisational
                            development</span></div>
                    <div class="mgmt-row"><span>Quality Assurance Manager</span><span>Ensure product quality and food
                            safety standards</span></div>
                    <div class="mgmt-row"><span>Feed Mill Manager</span><span>Oversee feed production and quality</span>
                    </div>
                    <div class="mgmt-row"><span>Hatchery Manager</span><span>Manage incubation and chick
                            production</span></div>
                </div>
            </div>

            <div class="photo-grid reveal" style="margin-top:50px;">
                <figure>
                    <img src="images/img-1.jpeg" alt="ALIRA Farm livestock operations">
                    <figcaption>Farm Operations</figcaption>
                </figure>
                <figure>
                    <img src="images/img-11.jpeg" alt="ALIRA Farm site view">
                    <figcaption>On‑Site Management</figcaption>
                </figure>
            </div>

            <a href="index.php#top" class="back-home reveal">← Back to Home</a>
        </div>
    </section>

<?php require 'includes/footer.php'; ?>
