<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db.php';

$data  = json_decode(file_get_contents('php://input'), true);
$empId = (int)($data['emp_id'] ?? 0);
$pin   = trim($data['pin'] ?? '');

if (!$empId || !$pin) { echo json_encode(['success'=>false,'message'=>'Invalid request.']); exit; }

$pdo  = getPDO();
$stmt = $pdo->prepare('SELECT pin FROM employees WHERE id = ? AND status="active" LIMIT 1');
$stmt->execute([$empId]);
$emp  = $stmt->fetch();

if (!$emp || $emp['pin'] !== $pin) { echo json_encode(['success'=>false,'message'=>'Incorrect PIN.']); exit; }

// Fetch today's attendance
$today = date('Y-m-d');
$att   = $pdo->prepare('SELECT * FROM attendance WHERE employee_id = ? AND date = ? LIMIT 1');
$att->execute([$empId, $today]);
$record = $att->fetch();

echo json_encode(['success'=>true,'attendance'=>$record ?: null]);
