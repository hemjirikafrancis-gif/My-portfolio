<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

include "db.php";

session_start();

function clean($data) {
    return htmlspecialchars(trim($data));
}

// Collect data
$first_name = clean($_POST['first_name'] ?? '');
$last_name  = clean($_POST['last_name'] ?? '');
$email      = clean($_POST['email'] ?? '');
$phone      = clean($_POST['phone'] ?? '');
$subject    = clean($_POST['subject'] ?? '');
$message    = clean($_POST['message'] ?? '');

$errors = [];

// VALIDATION
if (!$first_name) $errors['first_name'] = "First name required";
if (!$last_name)  $errors['last_name'] = "Last name required";

if (!$email) {
    $errors['email'] = "Email required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email";
}

if (!$subject)  $errors['subject'] = "Subject required";
if (!$message)  $errors['message'] = "Message required";

// IF ERROR → go back
if (!empty($errors)) {

    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;

    header("Location: contact.php?status=error");
    exit;
}

// SAVE TO DATABASE
$sql = "INSERT INTO contact_messages 
(first_name, last_name, email, phone, subject, message)
VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "ssssss",
    $first_name,
    $last_name,
    $email,
    $phone,
    $subject,
    $message
);

$stmt->execute();
$stmt->close();


// ==========================
// SEND EMAIL WITH PHPMAILER
// ==========================

$fullName = $first_name . " " . $last_name;

$mail = new PHPMailer(true);

try {

    // SMTP SETTINGS
$mail->isSMTP();
$mail->Host = 'sandbox.smtp.mailtrap.io';
$mail->SMTPAuth = true;
$mail->Port = 2525;
$mail->Username = 'c0df0e14377295';
$mail->Password = '3c0829bf95ae12';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;


    // FROM
    $mail->setFrom('from@app.com', 'Website Contact Form');

    // TO
     $mail->addAddress($email, $name);
    // REPLY TO USER
    // $mail->addReplyTo($email, $fullName);

    // EMAIL CONTENT
    $mail->isHTML(true);

    $mail->Subject = "Contact Form: $subject";

    $mail->Body = "
        <h2>New Contact Form Message</h2>

        <p><strong>Name:</strong> {$fullName}</p>

        <p><strong>Email:</strong> {$email}</p>

        <p><strong>Phone:</strong> {$phone}</p>

        <p><strong>Subject:</strong> {$subject}</p>

        <p><strong>Message:</strong><br>{$message}</p>
    ";

    $mail->send();

    // SUCCESS
    header("Location: contact.php?status=success");
    exit;

} catch (Exception $e) {

    echo "Message could not be sent.";
    echo "Mailer Error: " . $mail->ErrorInfo;
}
?>