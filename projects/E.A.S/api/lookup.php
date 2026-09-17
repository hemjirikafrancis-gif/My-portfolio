<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db.php';

$data = json_decode(file_get_contents('php://input'), true);
$empId = trim($data['emp_id'] ?? '');

if (!$empId) { echo json_encode(['success'=>false,'message'=>'Employee ID required.']); exit; }

$pdo  = getPDO();
$stmt = $pdo->prepare('
    SELECT e.id, e.emp_id, e.full_name, e.position, e.work_start_time, e.grace_period_minutes, e.status,
           d.name AS department
    FROM employees e
    LEFT JOIN departments d ON d.id = e.department_id
    WHERE e.emp_id = ? AND e.status = "active"
    LIMIT 1
');
$stmt->execute([$empId]);
$emp = $stmt->fetch();

if (!$emp) { echo json_encode(['success'=>false,'message'=>'Employee not found or inactive.']); exit; }

echo json_encode(['success'=>true,'employee'=>$emp]);