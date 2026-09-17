<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();

$pdo = getPDO();

// Quick stats
$totalEmp   = $pdo->query('SELECT COUNT(*) FROM employees WHERE status="active"')->fetchColumn();
$todayDate  = date('Y-m-d');
$todayClockedIn  = $pdo->prepare('SELECT COUNT(*) FROM attendance WHERE date=? AND clock_in IS NOT NULL');
$todayClockedIn->execute([$todayDate]);
$todayClockedIn = $todayClockedIn->fetchColumn();

$todayLate  = $pdo->prepare('SELECT COUNT(*) FROM attendance WHERE date=? AND minutes_late > 0');
$todayLate->execute([$todayDate]);
$todayLate  = $todayLate->fetchColumn();

$monthPenalty = $pdo->prepare('SELECT COALESCE(SUM(penalty_amount),0) FROM attendance WHERE MONTH(date)=? AND YEAR(date)=?');
$monthPenalty->execute([date('n'), date('Y')]);
$monthPenalty = (float)$monthPenalty->fetchColumn();

// Recent attendance
$recent = $pdo->prepare('
    SELECT a.*, e.full_name, e.emp_id, d.name AS dept
    FROM attendance a
    JOIN employees e ON e.id = a.employee_id
    LEFT JOIN departments d ON d.id = e.department_id
    WHERE a.date = ?
    ORDER BY a.clock_in DESC
    LIMIT 20
');
$recent->execute([$todayDate]);
$records = $recent->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>E.A.S. — Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Mono:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<?php include 'partials/nav.php'; ?>
<div class="page-wrap">
  <div class="page-header">
    <h1>Dashboard</h1>
    <span class="date-badge"><?= date('l, F j, Y') ?></span>
  </div>

  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-icon s-blue">👥</div>
      <div class="stat-val"><?= $totalEmp ?></div>
      <div class="stat-label">Active Staff</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon s-green">✅</div>
      <div class="stat-val"><?= $todayClockedIn ?></div>
      <div class="stat-label">Clocked In Today</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon s-yellow">⚠️</div>
      <div class="stat-val"><?= $todayLate ?></div>
      <div class="stat-label">Late Today</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon s-red">₦</div>
      <div class="stat-val">₦<?= number_format($monthPenalty) ?></div>
      <div class="stat-label">Penalties This Month</div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h2>Today's Attendance</h2>
      <span class="badge"><?= count($records) ?> records</span>
    </div>
    <div class="table-wrap">
    <table>
      <thead><tr><th>Emp ID</th><th>Name</th><th>Department</th><th>Clock In</th><th>Clock Out</th><th>Minutes Late</th><th>Penalty</th><th>Status</th></tr></thead>
      <tbody>
      <?php if(empty($records)): ?>
        <tr><td colspan="8" class="empty">No attendance records for today yet.</td></tr>
      <?php else: foreach($records as $r): ?>
        <tr>
          <td><span class="mono"><?= htmlspecialchars($r['emp_id']) ?></span></td>
          <td><?= htmlspecialchars($r['full_name']) ?></td>
          <td><?= htmlspecialchars($r['dept'] ?? '—') ?></td>
          <td><?= $r['clock_in'] ? date('H:i', strtotime($r['clock_in'])) : '—' ?></td>
          <td><?= $r['clock_out'] ? date('H:i', strtotime($r['clock_out'])) : '—' ?></td>
          <td><?= $r['minutes_late'] > 0 ? '<span class="late-badge">'.$r['minutes_late'].' min</span>' : '—' ?></td>
          <td><?= $r['penalty_amount'] > 0 ? '<span class="penalty-tag">₦'.number_format($r['penalty_amount']).'</span>' : '—' ?></td>
          <td>
            <?php if($r['clock_out']): ?>
              <span class="tag tag-done">Completed</span>
            <?php elseif($r['clock_in']): ?>
              <span class="tag tag-in">Working</span>
            <?php else: ?>
              <span class="tag tag-out">Absent</span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
    </div>
  </div>
</div>
</body>
</html>
