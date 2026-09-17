<?php
/**
 * Mail settings for the portfolio contact form.
 *
 * ============================================================
 *  DEMO MODE (current) — Mailtrap Sandbox
 * ============================================================
 * Messages go to a Mailtrap sandbox inbox, NOT a real inbox.
 * This is only so you (and anyone testing the form) can see
 * that submissions are actually sending, without spamming a
 * real email address while the site is still in progress.
 *
 * To connect your OWN Mailtrap sandbox instead of leaving the
 * placeholder values below:
 *   1. Go to https://mailtrap.io/sandboxes/ and open (or create) an inbox.
 *   2. Click the inbox -> "SMTP Settings" tab -> choose "PHPMailer".
 *   3. Copy the Username and Password shown there into
 *      SMTP_USERNAME and SMTP_PASSWORD below.
 *
 * ============================================================
 *  GOING LIVE — switch to a real inbox later
 * ============================================================
 * When you're ready for real messages to hit your real email:
 *   1. Set MAIL_MODE below to 'live'.
 *   2. Fill in the "LIVE SMTP SETTINGS" block with real
 *      credentials (e.g. your hosting email, Gmail SMTP with an
 *      app password, Zoho, SendGrid, etc).
 *   3. Set MAIL_TO_ADDRESS to the address you actually want to
 *      receive messages at.
 * That's it — contact.php reads everything from this one file,
 * so nothing else needs to change.
 */

// 'demo'  -> sends to the Mailtrap sandbox (safe testing, nothing is really delivered)
// 'live'  -> sends to a real inbox using the LIVE SMTP SETTINGS block below
define('MAIL_MODE', 'demo');

// ---- DEMO / MAILTRAP SANDBOX SETTINGS -------------------------------
define('DEMO_SMTP_HOST', 'sandbox.smtp.mailtrap.io');
define('DEMO_SMTP_PORT', 587);
define('DEMO_SMTP_USERNAME','b8099e1c116935');
define('DEMO_SMTP_PASSWORD', 'd70e145cfff21b');
define('DEMO_MAIL_TO_ADDRESS', 'demo-inbox@fhdev.com'); // arrives in Mailtrap only, not a real inbox

// ---- LIVE SMTP SETTINGS (fill in when you go live) -------------------
define('LIVE_SMTP_HOST', 'smtp.yourprovider.com');
define('LIVE_SMTP_PORT', 587);
define('LIVE_SMTP_USERNAME', 'you@yourdomain.com');
define('LIVE_SMTP_PASSWORD', 'your-real-password-or-app-password');
define('LIVE_MAIL_TO_ADDRESS', 'you@yourdomain.com'); // where real messages should land

// ---- Shared "from" details (shown as the sender name/address) --------
define('MAIL_FROM_ADDRESS', 'no-reply@fhdev.com');
define('MAIL_FROM_NAME', 'F.H Portfolio Website');

// ---- Resolved settings (contact.php uses these — no need to touch) ---
if (MAIL_MODE === 'live') {
    define('SMTP_HOST', LIVE_SMTP_HOST);
    define('SMTP_PORT', LIVE_SMTP_PORT);
    define('SMTP_USERNAME', LIVE_SMTP_USERNAME);
    define('SMTP_PASSWORD', LIVE_SMTP_PASSWORD);
    define('MAIL_TO_ADDRESS', LIVE_MAIL_TO_ADDRESS);
} else {
    define('SMTP_HOST', DEMO_SMTP_HOST);
    define('SMTP_PORT', DEMO_SMTP_PORT);
    define('SMTP_USERNAME', DEMO_SMTP_USERNAME);
    define('SMTP_PASSWORD', DEMO_SMTP_PASSWORD);
    define('MAIL_TO_ADDRESS', DEMO_MAIL_TO_ADDRESS);
}