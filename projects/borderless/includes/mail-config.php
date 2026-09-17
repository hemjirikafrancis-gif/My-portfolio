<?php
/**
 * Mailtrap SMTP settings (sandbox / testing).
 * Get these from: https://mailtrap.io/sandboxes/  -> your inbox -> SMTP Settings tab.
 * Edit the 4 values below to match YOUR sandbox.
 */
define('SMTP_HOST', 'sandbox.smtp.mailtrap.io');
define('SMTP_PORT', 587);              // Mailtrap also offers 25, 465, 587
define('SMTP_USERNAME', '2afa83d05f2126');
define('SMTP_PASSWORD', '7a84f1c373a125');

define('MAIL_FROM_ADDRESS', 'no-reply@borderlessanalysts.com');
define('MAIL_FROM_NAME', 'Borderless Analysts Website');
define('MAIL_TO_ADDRESS', 'info@borderlessanalysts.com'); // where the message "arrives" (in Mailtrap's sandbox, not a real inbox)