<?php
/**
 * prescription-upload-handler.php
 *
 * Handles submissions from the form on prescription.php.
 * - Validates required fields and the uploaded file.
 * - Saves the file into /uploads/prescriptions/ under a random, safe name.
 * - Appends a JSON record (no raw file re-use, no double-encoding) to
 *   /data/prescriptions.json so the front desk / pharmacist can review it.
 * - Responds with JSON when called via fetch() (main.js), or redirects
 *   back to prescription.php with a status flag for a plain form fallback.
 *
 * NOTE: This does not send email/SMS notifications. Wire up a mailer
 * (e.g. PHPMailer, as used on the contact form) or a cron job that reads
 * data/prescriptions.json if you need staff to be alerted automatically.
 */

declare(strict_types=1);

const MAX_FILE_BYTES = 8 * 1024 * 1024; // 8MB
const ALLOWED_EXT    = ['jpg', 'jpeg', 'png', 'pdf'];
const ALLOWED_MIME   = [
    'image/jpeg' => ['jpg', 'jpeg'],
    'image/png'  => ['png'],
    'application/pdf' => ['pdf'],
];
const UPLOAD_DIR = __DIR__ . '/uploads/prescriptions/';
const DATA_FILE  = __DIR__ . '/data/prescriptions.json';

function wantsJson(): bool
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'fetch';
}

function respond(bool $ok, string $message, array $extra = []): void
{
    if (wantsJson()) {
        header('Content-Type: application/json');
        echo json_encode(array_merge(['ok' => $ok, 'message' => $message], $extra));
        exit;
    }
    $status = $ok ? 'success' : 'error';
    header('Location: prescription.php?rx=' . $status . '&msg=' . urlencode($message));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method.');
}

// ---- Required text fields ----
$patientName = trim((string)($_POST['patient_name'] ?? ''));
$phone       = trim((string)($_POST['phone'] ?? ''));
$email       = trim((string)($_POST['email'] ?? ''));
$address     = trim((string)($_POST['address'] ?? ''));
$notes       = trim((string)($_POST['notes'] ?? ''));
$fulfilment  = ($_POST['fulfilment'] ?? 'pickup') === 'delivery' ? 'delivery' : 'pickup';

if ($patientName === '' || $phone === '') {
    respond(false, 'Full name and phone number are required.');
}
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond(false, 'Please enter a valid email address, or leave it blank.');
}
if ($fulfilment === 'delivery' && $address === '') {
    respond(false, 'Please provide a delivery address, or switch to pickup.');
}

// ---- File upload ----
if (!isset($_FILES['prescription_file']) || $_FILES['prescription_file']['error'] === UPLOAD_ERR_NO_FILE) {
    respond(false, 'Please attach a photo, scan or PDF of your prescription.');
}

$file = $_FILES['prescription_file'];

if ($file['error'] !== UPLOAD_ERR_OK) {
    respond(false, 'The file failed to upload. Please try again.');
}
if ($file['size'] > MAX_FILE_BYTES) {
    respond(false, 'That file is larger than 8MB. Please upload a smaller file.');
}

$originalExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$finfo       = finfo_open(FILEINFO_MIME_TYPE);
$detectedMime = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if (
    !in_array($originalExt, ALLOWED_EXT, true) ||
    !isset(ALLOWED_MIME[$detectedMime]) ||
    !in_array($originalExt, ALLOWED_MIME[$detectedMime], true)
) {
    respond(false, 'Unsupported file type. Please upload a JPG, PNG or PDF.');
}

if (!is_dir(UPLOAD_DIR) && !mkdir(UPLOAD_DIR, 0755, true) && !is_dir(UPLOAD_DIR)) {
    respond(false, 'Server storage is unavailable right now. Please try again shortly.');
}

$safeName = bin2hex(random_bytes(16)) . '.' . $originalExt;
$destPath = UPLOAD_DIR . $safeName;

if (!move_uploaded_file($file['tmp_name'], $destPath)) {
    respond(false, 'We could not save your file. Please try again.');
}

// ---- Persist a record (flat-file JSON, matching the site's blog-CMS pattern) ----
$record = [
    'id'            => bin2hex(random_bytes(8)),
    'patient_name'  => $patientName,
    'phone'         => $phone,
    'email'         => $email,
    'fulfilment'    => $fulfilment,
    'address'       => $address,
    'notes'         => $notes,
    'file'          => $safeName,
    'original_name' => $file['name'],
    'submitted_at'  => date('c'),
    'status'        => 'pending_review',
];

$existing = [];
if (is_readable(DATA_FILE)) {
    $raw = file_get_contents(DATA_FILE);
    $decoded = json_decode($raw ?: '[]', true);
    if (is_array($decoded)) {
        $existing = $decoded;
    }
}
$existing[] = $record;

$fp = fopen(DATA_FILE, 'c+');
if ($fp && flock($fp, LOCK_EX)) {
    ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
} else {
    respond(false, 'Your file was saved, but we could not log your submission. Please call us to confirm.');
}

respond(true, "Thank you — your prescription has been received. A pharmacist will reach you at {$phone} to confirm availability and " . ($fulfilment === 'delivery' ? 'delivery.' : 'pickup.'));
