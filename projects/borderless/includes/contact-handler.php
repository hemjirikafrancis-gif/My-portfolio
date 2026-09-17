<?php
/**
 * Handles the Contact Us form submission and sends it through Mailtrap (SMTP).
 * Included at the top of contact.php.
 */

require_once __DIR__ . '/mail-config.php';
require_once __DIR__ . '/PHPMailer/Exception.php';
require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!function_exists('e')) {
    function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
}

$formStatus = null;   // 'success' | 'error' | null
$formError  = '';
$formDebug  = '';     // on-page diagnostic transcript, shown directly in contact.php

// Keep submitted values so the form can be re-filled if something goes wrong
$old = [
    'first_name' => '',
    'last_name'  => '',
    'email'      => '',
    'phone'      => '',
    'company'    => '',
    'service'    => '',
    'message'    => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {

    $old['first_name'] = trim($_POST['first_name'] ?? '');
    $old['last_name']  = trim($_POST['last_name'] ?? '');
    $old['email']      = trim($_POST['email'] ?? '');
    $old['phone']      = trim($_POST['phone'] ?? '');
    $old['company']    = trim($_POST['company'] ?? '');
    $old['service']    = trim($_POST['service'] ?? '');
    $old['message']    = trim($_POST['message'] ?? '');

    // --- basic validation ---
    if ($old['first_name'] === '' || $old['last_name'] === '' || $old['email'] === '' ||
        $old['service'] === '' || $old['message'] === '') {
        $formStatus = 'error';
        $formError  = 'Please fill in all required fields (marked *).';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formError  = 'Please enter a valid email address.';
    } else {
        $mail = new PHPMailer(true);
        try {
            // --- Mailtrap SMTP ---
            $mail->isSMTP();
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = SMTP_USERNAME;
            $mail->Password   = SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = SMTP_PORT;
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true,
                ],
            ];
            $mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
            $mail->addAddress(MAIL_TO_ADDRESS);
            $mail->addReplyTo($old['email'], $old['first_name'] . ' ' . $old['last_name']);

            // --- TEMPORARY DEBUG LOGGING (remove once mail is confirmed working) ---
            $mail->SMTPDebug = 2; // 0 = off, 2 = client/server messages
            $debugLog = '';
            $mail->Debugoutput = function ($str, $level) use (&$debugLog) {
                $debugLog .= $str . "\n";
            };

            $mail->isHTML(true);
            $mail->Subject = 'New Contact Form Submission – ' . $old['service'];
            $mail->Body    = '
                <h2>New message from the Borderless Analysts contact form</h2>
                <p><strong>Name:</strong> ' . e($old['first_name']) . ' ' . e($old['last_name']) . '</p>
                <p><strong>Email:</strong> ' . e($old['email']) . '</p>
                <p><strong>Phone:</strong> ' . e($old['phone'] ?: '—') . '</p>
                <p><strong>Company:</strong> ' . e($old['company'] ?: '—') . '</p>
                <p><strong>Service of Interest:</strong> ' . e($old['service']) . '</p>
                <p><strong>Message:</strong><br>' . nl2br(e($old['message'])) . '</p>
            ';
            $mail->AltBody = "New contact form submission\n\n"
                . "Name: {$old['first_name']} {$old['last_name']}\n"
                . "Email: {$old['email']}\n"
                . "Phone: {$old['phone']}\n"
                . "Company: {$old['company']}\n"
                . "Service: {$old['service']}\n\n"
                . "Message:\n{$old['message']}";

            $mail->send();

            // Build an on-page diagnostic transcript (shown directly on contact.php,
            // not written to a log file — removes any ambiguity about which file
            // you're looking at or whether the write succeeded).
            $formDebug = "SMTP_HOST used: " . SMTP_HOST . "\n"
                . "SMTP_PORT used: " . SMTP_PORT . "\n"
                . "SMTP_USERNAME used: " . SMTP_USERNAME . "\n"
                . "mail-config.php loaded from: " . realpath(__DIR__ . '/mail-config.php') . "\n"
                . "contact-handler.php running from: " . __FILE__ . "\n"
                . "PHPMailer send() returned: true (no exception thrown)\n\n"
                . "--- SMTP transcript ---\n" . $debugLog;

            // Also try writing the log file, but don't depend on it — record
            // whether the write itself succeeded so we can see that on-page too.
            $writeOk = @file_put_contents(__DIR__ . '/mail-debug.log',
                "=== " . date('Y-m-d H:i:s') . " ===\n"
                . "Host: " . SMTP_HOST . " Port: " . SMTP_PORT . " Username: " . SMTP_USERNAME . "\n"
                . $debugLog . "\n\n",
                FILE_APPEND
            );
            $formDebug .= "\nmail-debug.log write result: " . ($writeOk === false ? 'FAILED (' . (error_get_last()['message'] ?? 'unknown reason') . ')' : $writeOk . ' bytes written');

            $formStatus = 'success';
            $old = array_fill_keys(array_keys($old), ''); // clear the form on success

        } catch (Exception $e) {
            $formDebug = "SMTP_HOST used: " . SMTP_HOST . "\n"
                . "SMTP_PORT used: " . SMTP_PORT . "\n"
                . "SMTP_USERNAME used: " . SMTP_USERNAME . "\n"
                . "contact-handler.php running from: " . __FILE__ . "\n"
                . "Error: " . $mail->ErrorInfo . "\n\n"
                . "--- SMTP transcript ---\n" . $debugLog;

            @file_put_contents(__DIR__ . '/mail-debug.log',
                "=== " . date('Y-m-d H:i:s') . " ERROR ===\n"
                . "Host: " . SMTP_HOST . " Port: " . SMTP_PORT . " Username: " . SMTP_USERNAME . "\n"
                . $debugLog . "\n"
                . "Error: " . $mail->ErrorInfo . "\n\n",
                FILE_APPEND
            );
            $formStatus = 'error';
            $formError  = 'Sorry, the message could not be sent. (' . $mail->ErrorInfo . ')';
        }
    }
}