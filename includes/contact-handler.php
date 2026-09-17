<?php
/**
 * Handles the portfolio Contact form submission and sends it via PHPMailer/SMTP.
 * Included at the top of contact.php, before any HTML is output.
 *
 * Reads all connection settings (demo Mailtrap vs. live) from mail-config.php.
 * Nothing in this file needs to change when going live — just flip MAIL_MODE
 * in mail-config.php.
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

$formStatus = null; // 'success' | 'error' | null
$formError  = '';

// Keep submitted values so the form can be re-filled if something goes wrong
$old = [
    'name'    => '',
    'email'   => '',
    'subject' => '',
    'message' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $old['name']    = trim($_POST['name'] ?? '');
    $old['email']   = trim($_POST['email'] ?? '');
    $old['subject'] = trim($_POST['subject'] ?? '');
    $old['message'] = trim($_POST['message'] ?? '');

    
    if ($old['name'] === '' || $old['email'] === '' || $old['subject'] === '' || $old['message'] === '') {
        $formStatus = 'error';
        $formError  = 'Please fill in every field before sending.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formError  = 'Please enter a valid email address.';
    } else {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'b8099e1c116935';
            $mail->Password   = 'd70e145cfff21b';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

           
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true,
                ],
            ];

            $mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
            $mail->addAddress(MAIL_TO_ADDRESS);
            $mail->addReplyTo($old['email'], $old['name']);

            $mail->isHTML(true);
            $mail->Subject = 'Portfolio contact form: ' . $old['subject'];
            $mail->Body    = '
                <h2>New message from the portfolio contact form</h2>
                <p><strong>Name:</strong> ' . e($old['name']) . '</p>
                <p><strong>Email:</strong> ' . e($old['email']) . '</p>
                <p><strong>Subject:</strong> ' . e($old['subject']) . '</p>
                <p><strong>Message:</strong><br>' . nl2br(e($old['message'])) . '</p>
            ';
            $mail->AltBody = "New portfolio contact form submission\n\n"
                . "Name: {$old['name']}\n"
                . "Email: {$old['email']}\n"
                . "Subject: {$old['subject']}\n\n"
                . "Message:\n{$old['message']}";

            $mail->send();

            $formStatus = 'success';
            $old = array_fill_keys(array_keys($old), ''); // clear the form on success

        } catch (Exception $e) {
            $formStatus = 'error';
            $formError  = (MAIL_MODE === 'demo')
                ? 'Could not send right now (' . $mail->ErrorInfo . '). Double-check the Mailtrap credentials in includes/mail-config.php.'
                : 'Sorry, the message could not be sent. Please try again in a moment.';
        }
    }
}