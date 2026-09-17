<?php

session_start();
require 'vendor/autoload.php';
include "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



function clean($data)
{
    return htmlspecialchars(trim($data));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

$full_name = clean($_POST['full_name'] ?? '');
$email     = clean($_POST['email'] ?? '');
$subject   = clean($_POST['subject'] ?? '');
$message   = clean($_POST['message'] ?? '');

$errors = [];

if (empty($full_name)) {
    $errors['full_name'] = 'Full name is required';
}

if (empty($email)) {
    $errors['email'] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid email address';
}

if (empty($subject)) {
    $errors['subject'] = 'Subject is required';
}

if (empty($message)) {
    $errors['message'] = 'Message is required';
}

if (!empty($errors)) {

    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;

    header('Location: contact.php?status=error');
    exit;
}

/*
|--------------------------------------------------------------------------
| SAVE TO DATABASE
|--------------------------------------------------------------------------
*/

$sql = "INSERT INTO contact_messages
        (full_name, email, subject, message)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "ssss",
    $full_name,
    $email,
    $subject,
    $message
);

if (!$stmt->execute()) {

    $_SESSION['error'] = 'Failed to save message.';

    header('Location: contact.php?status=error');
    exit;
}

$stmt->close();

/*
|--------------------------------------------------------------------------
| SEND EMAIL (optional — success does not depend on this)
|--------------------------------------------------------------------------
*/

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host       = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'c0df0e14377295';
    $mail->Password   = '3c0829bf95ae12';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 2525;

    // Sender
    $mail->setFrom('from@app.com', 'Website Contact Form');

    // Recipient (YOU)
    $mail->addAddress('your-email@example.com', 'Website Owner');

    // Reply to visitor
    $mail->addReplyTo($email, $full_name);

    $mail->isHTML(true);

    $mail->Subject = "New Contact Form Message: {$subject}";

    $mail->Body = "
        <h2>New Contact Form Submission</h2>

        <p><strong>Full Name:</strong> {$full_name}</p>

        <p><strong>Email:</strong> {$email}</p>

        <p><strong>Subject:</strong> {$subject}</p>

        <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
    ";

    $mail->send();

} catch (Exception $e) {
    // Email failed but message was already saved to DB — that's fine.
    // Optionally log the error: error_log($mail->ErrorInfo);
}

$conn->close();

// Always redirect to success — the DB save is what matters
header('Location: contact.php?status=success');
exit;
