<?php
/* Handles the contact form submission and saves it to the database. */

header('Content-Type: application/json');
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
    exit;
}

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $message === '') {
    echo json_encode(["success" => false, "message" => "Please fill in all required fields."]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["success" => false, "message" => "Please enter a valid email address."]);
    exit;
}

$stmt = mysqli_prepare($conn, "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(["success" => true, "message" => "Thank you — your message has been sent. We'll be in touch shortly."]);
} else {
    echo json_encode(["success" => false, "message" => "Something went wrong. Please try again."]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
