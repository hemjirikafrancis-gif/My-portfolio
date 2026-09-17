<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db.php';

$data  = json_decode(file_get_contents('php://input'), true);
$empId = (int)($data['emp_id'] ?? 0);
if (!$empId) { echo json_encode(['success'=>false,'message'=>'Invalid request.']); exit; }

$pdo   = getPDO();
$today = date('Y-m-d');
$now   = date('Y-m-d H:i:s');

$check = $pdo->prepare('SELECT * FROM attendance WHERE employee_id=? AND date=? LIMIT 1');
$check->execute([$empId, $today]);
$record = $check->fetch();

if (!$record || !$record['clock_in']) { echo json_encode(['success'=>false,'message'=>'You have not clocked in today.']); exit; }
if ($record['clock_out']) { echo json_encode(['success'=>false,'message'=>'Already clocked out today.']); exit; }

$pdo->prepare('UPDATE attendance SET clock_out=? WHERE id=?')->execute([$now, $record['id']]);

// Calculate duration
$ci       = new DateTime($record['clock_in']);
$co       = new DateTime($now);
$diff     = $ci->diff($co);
$duration = $diff->format('%h hr %i min');

echo json_encode([
    'success'  => true,
    'type'     => 'clock_out',
    'time'     => date('H:i:s'),
    'duration' => $duration,
]);
