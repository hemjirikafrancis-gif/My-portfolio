<?php
$is_home = false;
$page_title = "Vision & Mission — ALIRA Farm";
$page_description = "ALIRA Farm's vision, mission and the four pillars that guide our integrated poultry agribusiness in Nigeria.";
require 'includes/header.php';
?>

    <!-- ============ PAGE HERO ============ -->
    <section class="page-hero">
        <div class="page-hero-inner">
            <p class="breadcrumb"><a href="index.php">Home</a> / Vision &amp; Mission</p>
            <h1 class="page-hero-title">Where we're headed, and why.</h1>
            <p class="page-hero-lede">
                Our vision and mission — and the four pillars of practice that turn
                them into everyday decisions across the farm.
            </p>
        </div>
    </section>

    <!-- ============ VISION & MISSION — FULL ============ -->
    <section class="section" id="vision-full">
        <div class="section-inner">
            <div class="vm-grid">
                <div class="vm-card reveal" style="background:var(--parchment); border-color:var(--line);">
                    <span class="vm-tag">Vision</span>
                    <p style="color:rgba(27,29,16,.8);">
                        To become Nigeria's leading integrated poultry brand — recognized
                        for excellence in quality, innovation and sustainability —
                        transforming the nation's poultry landscape and setting the
                        benchmark for agro‑industrial development in West Africa.
                    </p>
                </div>
                <div class="vm-card reveal" style="background:var(--parchment); border-color:var(--line);">
                    <span class="vm-tag">Mission</span>
                    <p style="color:rgba(27,29,16,.8);">
                        To build a self‑sustaining, technology‑driven poultry ecosystem
                        that delivers affordable, high‑quality animal protein to
                        Nigerians while creating employment, empowering local farmers and
                        driving agricultural transformation.
                    </p>
                </div>
            </div>

            <figure class="banner-figure reveal">
                <img src="images/img-5.jpeg" alt="ALIRA Farm facilities and equipment">
                <figcaption>Building the infrastructure behind the mission</figcaption>
            </figure>

            <h3 class="sub-heading reveal">The Four Pillars</h3>
            <div class="pillars reveal" style="margin-top:10px;">
                <div class="pillar" style="border-top-color:var(--line);">
                    <span class="pillar-icon" style="color:var(--gold);">⌁</span>
                    <p style="color:rgba(27,29,16,.75);">Vertical integration across the entire poultry value chain</p>
                </div>
                <div class="pillar" style="border-top-color:var(--line);">
                    <span class="pillar-icon" style="color:var(--gold);">⟲</span>
                    <p style="color:rgba(27,29,16,.75);">Sustainable practices that minimise impact, maximise efficiency</p>
                </div>
                <div class="pillar" style="border-top-color:var(--line);">
                    <span class="pillar-icon" style="color:var(--gold);">⟡</span>
                    <p style="color:rgba(27,29,16,.75);">Community engagement through out‑grower &amp; farmer training</p>
                </div>
                <div class="pillar" style="border-top-color:var(--line);">
                    <span class="pillar-icon" style="color:var(--gold);">✦</span>
                    <p style="color:rgba(27,29,16,.75);">Innovation in production, processing and distribution</p>
                </div>
            </div>

            <div class="orbit-cluster reveal" style="margin-top:56px;">
                <div class="photo-orbit">
                    <img src="images/img-6.jpeg" alt="ALIRA Farm team at work">
                    <svg class="orbit-ring" viewBox="0 0 220 220" aria-hidden="true">
                        <circle cx="110" cy="110" r="104" />
                    </svg>
                </div>
                <div class="photo-orbit spin-reverse">
                    <img src="images/img-13.jpeg" alt="ALIRA Farm poultry care">
                    <svg class="orbit-ring" viewBox="0 0 220 220" aria-hidden="true">
                        <circle cx="110" cy="110" r="104" />
                    </svg>
                </div>
            </div>

            <a href="index.php#top" class="back-home reveal">← Back to Home</a>
        </div>
    </section>

<?php require 'includes/footer.php'; ?>
