<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/penalty.php';

$data  = json_decode(file_get_contents('php://input'), true);
$empId = (int)($data['emp_id'] ?? 0);
if (!$empId) { echo json_encode(['success'=>false,'message'=>'Invalid request.']); exit; }

$pdo   = getPDO();
$today = date('Y-m-d');
$now   = date('Y-m-d H:i:s');

// Check already clocked in
$check = $pdo->prepare('SELECT id, clock_in FROM attendance WHERE employee_id=? AND date=? LIMIT 1');
$check->execute([$empId, $today]);
$existing = $check->fetch();
if ($existing && $existing['clock_in']) { echo json_encode(['success'=>false,'message'=>'Already clocked in today.']); exit; }

// Get employee details
$emp = $pdo->prepare('SELECT work_start_time, grace_period_minutes, monthly_salary FROM employees WHERE id=? LIMIT 1');
$emp->execute([$empId]);
$e = $emp->fetch();

$minsLate = minutesLate($now, $e['work_start_time'], (int)$e['grace_period_minutes']);
$penalty  = calculatePenalty($minsLate, (float)$e['monthly_salary']);

$pdo->prepare('
    INSERT INTO attendance (employee_id, date, clock_in, minutes_late, penalty_amount)
    VALUES (?,?,?,?,?)
    ON DUPLICATE KEY UPDATE clock_in=VALUES(clock_in), minutes_late=VALUES(minutes_late), penalty_amount=VALUES(penalty_amount)
')->execute([$empId, $today, $now, $minsLate, $penalty]);

// Update monthly deduction
recalcMonthlyDeduction($empId, (int)date('n'), (int)date('Y'));

echo json_encode([
    'success'      => true,
    'type'         => 'clock_in',
    'time'         => date('H:i:s'),
    'minutes_late' => $minsLate,
    'penalty'      => $penalty,
]);
