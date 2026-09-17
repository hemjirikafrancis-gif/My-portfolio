<?php
/**
 * STANDALONE MAILTRAP DIAGNOSTIC
 * ------------------------------
 * Open this file directly in your browser:
 *   http://localhost/borderless/mail-test.php
 *
 * It proves three things at once, on screen (not just in a log file):
 *   1. Exactly which copy of the project WAMP is serving (path + file time)
 *   2. Whether PHP's openssl extension is enabled (required for Mailtrap STARTTLS)
 *   3. The full raw SMTP conversation with Mailtrap, so you can see the real
 *      pass/fail reason instead of just "success" or "error"
 *
 * Delete this file once mail is confirmed working — it's a debug tool only.
 */

require_once __DIR__ . '/includes/mail-config.php';
require_once __DIR__ . '/includes/PHPMailer/Exception.php';
require_once __DIR__ . '/includes/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/includes/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Mailtrap Diagnostic</title>
<style>
  body{font-family:Consolas,Menlo,monospace;background:#0f1115;color:#d8dee9;padding:30px;line-height:1.5;}
  h1{color:#88c0d0;font-size:1.2rem;} h2{color:#a3be8c;font-size:1rem;margin-top:28px;}
  .ok{color:#a3be8c;} .bad{color:#bf616a;font-weight:bold;} .warn{color:#ebcb8b;}
  pre{background:#1b1e27;padding:14px;border-radius:6px;overflow-x:auto;white-space:pre-wrap;}
  code{color:#88c0d0;}
</style>
</head>
<body>
<h1>🔧 Borderless Analysts — Mailtrap Diagnostic</h1>

<h2>1. Which files WAMP is actually serving</h2>
<pre>This script's path:   <?php echo __FILE__; ?>
mail-config.php path: <?php echo __DIR__ . '/includes/mail-config.php'; ?>
File last modified:   <?php echo date('Y-m-d H:i:s', filemtime(__DIR__ . '/includes/mail-config.php')); ?>
Server document root: <?php echo $_SERVER['DOCUMENT_ROOT'] ?? 'unknown'; ?>
</pre>
<p><span class="warn">⚠ Compare "server document root" above to where you actually edit files in Windows.</span>
If they don't point to the same folder (e.g. you edit in <code>C:\wamp64\www\borderless</code> but Apache
is serving <code>C:\wamp64\www\borderless-old</code> or a second vhost), that alone explains "success shows
but nothing arrives" — your edits are never the code that runs.</p>

<h2>2. PHP environment</h2>
<pre>PHP version:      <?php echo PHP_VERSION; ?>

openssl loaded:   <?php echo extension_loaded('openssl') ? '✅ yes' : '❌ NO — required for STARTTLS on port 587'; ?>

opcache enabled:  <?php echo (function_exists('opcache_get_status') && opcache_get_status() !== false) ? '⚠ yes — if you edit PHP files and nothing changes, restart Apache (or disable opcache in php.ini for local dev)' : 'no'; ?>
</pre>

<h2>3. Config values being used right now</h2>
<pre>SMTP_HOST:         <?php echo SMTP_HOST; ?>

SMTP_PORT:         <?php echo SMTP_PORT; ?>

SMTP_USERNAME:     <?php echo SMTP_USERNAME; ?>

SMTP_PASSWORD:     <?php echo str_repeat('•', strlen(SMTP_PASSWORD)); ?> (<?php echo strlen(SMTP_PASSWORD); ?> chars)

MAIL_FROM_ADDRESS: <?php echo MAIL_FROM_ADDRESS; ?>

MAIL_TO_ADDRESS:   <?php echo MAIL_TO_ADDRESS; ?>
</pre>
<p class="warn">⚠ Open Mailtrap → your sandbox inbox → SMTP Settings tab and check these three values match
EXACTLY (username, password, host). Mailtrap gives each sandbox inbox its own credentials — if you're
looking at a different inbox in the dashboard than the one these credentials belong to, the email sends
fine but shows up in an inbox you're not looking at.</p>

<h2>4. Live send attempt (full SMTP transcript)</h2>
<pre><?php
$mail = new PHPMailer(true);
$transcript = '';
try {
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USERNAME;
    $mail->Password   = SMTP_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = SMTP_PORT;
    $mail->SMTPDebug  = 2;
    $mail->Debugoutput = function ($str, $level) use (&$transcript) {
        $transcript .= htmlspecialchars($str) . "\n";
    };

    $mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
    $mail->addAddress(MAIL_TO_ADDRESS);
    $mail->isHTML(false);
    $mail->Subject = 'Mailtrap diagnostic test — ' . date('H:i:s');
    $mail->Body    = "This is a test email sent by mail-test.php at " . date('Y-m-d H:i:s');

    $mail->send();
    echo $transcript;
    echo "\n<span class=\"ok\">✅ SUCCESS — PHPMailer reports Mailtrap accepted this message.</span>\n";
    echo "<span class=\"ok\">Go check the inbox tied to the SMTP_USERNAME above — it should be there now.</span>\n";
} catch (Exception $e) {
    echo $transcript;
    echo "\n<span class=\"bad\">❌ FAILED: " . htmlspecialchars($mail->ErrorInfo) . "</span>\n";
}
?></pre>

<h2>5. Log file check</h2>
<?php
$logPath = __DIR__ . '/includes/mail-debug.log';
if (is_writable(__DIR__ . '/includes/') || file_exists($logPath)) {
    $testWrite = @file_put_contents($logPath, "diagnostic check " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
    if ($testWrite !== false) {
        echo '<p class="ok">✅ includes/mail-debug.log is writable. Path: ' . htmlspecialchars($logPath) . '</p>';
    } else {
        echo '<p class="bad">❌ Could not write to includes/mail-debug.log — check folder permissions.</p>';
    }
} else {
    echo '<p class="bad">❌ includes/ folder is not writable by PHP.</p>';
}
?>

<p style="margin-top:30px;color:#666;">Delete this file (<code>mail-test.php</code>) once everything above is green.</p>
</body>
</html>
