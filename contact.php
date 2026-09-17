<?php
require_once __DIR__ . '/includes/contact-handler.php'; // must run before any HTML output (sets $formStatus, $formError, $old)

$pageTitle = 'Contact';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- ======================= PAGE HERO ======================= -->
<section class="page-hero">
    <div class="container">
        <div class="eyebrow">// Contact</div>
        <h1>Let's talk about what you're building.</h1>
        <p>Fill in the form below or reach me directly — I usually reply within a day.</p>
    </div>
</section>

<!-- ======================= CONTACT ======================= -->
<section class="contact">
    <div class="container contact-grid">

        <div class="contact-info reveal">
            <div class="eyebrow">// Get in touch</div>
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

        <div class="contact-form-wrap reveal">
            <?php if ($formStatus === 'success'): ?>
            <div class="form-status success">
                ✓ Thanks — your message sent. I'll get back to you within a day.
            </div>
            <?php elseif ($formStatus === 'error'): ?>
            <div class="form-status error">
                ✕ <?php echo e($formError); ?>
            </div>
            <?php endif; ?>

            <form class="contact-form" action="contact.php" method="POST">
                <div class="form-row">
                    <div class="field">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Your full name"
                            value="<?php echo e($old['name']); ?>" required>
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="you@email.com"
                            value="<?php echo e($old['email']); ?>" required>
                    </div>
                </div>

                <div class="field">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="What's this about?"
                        value="<?php echo e($old['subject']); ?>" required>
                </div>

                <div class="field">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Tell me a bit about the project..."
                        required><?php echo e($old['message']); ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Send message</button>
            </form>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>