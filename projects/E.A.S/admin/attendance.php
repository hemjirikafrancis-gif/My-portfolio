<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();
$pdo = getPDO();

$filterDate = $_GET['date'] ?? date('Y-m-d');
$filterEmp  = $_GET['emp'] ?? '';

$sql = 'SELECT a.*, e.full_name, e.emp_id AS eid, d.name AS dept
        FROM attendance a
        JOIN employees e ON e.id = a.employee_id
        LEFT JOIN departments d ON d.id = e.department_id
        WHERE a.date = ?';
$params = [$filterDate];
if ($filterEmp) { $sql .= ' AND e.emp_id = ?'; $params[] = $filterEmp; }
$sql .= ' ORDER BY a.clock_in DESC';
$stmt = $pdo->prepare($sql); $stmt->execute($params);
$records = $stmt->fetchAll();

$employees = $pdo->query('SELECT emp_id, full_name FROM employees WHERE status="active" ORDER BY full_name')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>E.A.S. — Attendance</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Mono:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<?php include 'partials/nav.php'; ?>
<div class="page-wrap">
  <div class="page-header">
    <h1>Attendance Records</h1>
  </div>

  <div class="filter-bar card">
    <form method="GET" style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end;">
      <div class="field"><label>Date</label><input type="date" name="date" value="<?= htmlspecialchars($filterDate) ?>"></div>
      <div class="field">
        <label>Employee</label>
        <select name="emp">
          <option value="">All Employees</option>
          <?php foreach($employees as $e): ?>
          <option value="<?= htmlspecialchars($e['emp_id']) ?>" <?= $filterEmp===$e['emp_id']?'selected':'' ?>><?= htmlspecialchars($e['full_name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" class="btn-primary">Filter</button>
      <a href="attendance.php" class="btn-outline-link">Reset</a>
    </form>
  </div>

  <div class="card">
    <div class="card-header">
      <h2>Results for <?= date('F j, Y', strtotime($filterDate)) ?></h2>
      <span class="badge"><?= count($records) ?> records</span>
    </div>
    <div class="table-wrap">
    <table>
      <thead><tr><th>Emp ID</th><th>Name</th><th>Dept</th><th>Clock In</th><th>Clock Out</th><th>Duration</th><th>Mins Late</th><th>Penalty (₦)</th><th>Status</th></tr></thead>
      <tbody>
      <?php if(empty($records)): ?>
        <tr><td colspan="9" class="empty">No records found.</td></tr>
      <?php else: foreach($records as $r):
        $dur = '—';
        if ($r['clock_in'] && $r['clock_out']) {
            $diff = (new DateTime($r['clock_out']))->diff(new DateTime($r['clock_in']));
            $dur  = $diff->format('%hh %im');
        }
      ?>
      <tr>
        <td><span class="mono"><?= htmlspecialchars($r['eid']) ?></span></td>
        <td><?= htmlspecialchars($r['full_name']) ?></td>
        <td><?= htmlspecialchars($r['dept'] ?? '—') ?></td>
        <td><?= $r['clock_in'] ? date('H:i:s', strtotime($r['clock_in'])) : '—' ?></td>
        <td><?= $r['clock_out'] ? date('H:i:s', strtotime($r['clock_out'])) : '—' ?></td>
        <td><?= $dur ?></td>
        <td><?= $r['minutes_late'] > 0 ? '<span class="late-badge">'.$r['minutes_late'].'</span>' : '—' ?></td>
        <td><?= $r['penalty_amount'] > 0 ? '<span class="penalty-tag">'.number_format($r['penalty_amount']).'</span>' : '—' ?></td>
        <td>
          <?php if($r['clock_out']): ?><span class="tag tag-done">Completed</span>
          <?php elseif($r['clock_in']): ?><span class="tag tag-in">Working</span>
          <?php else: ?><span class="tag tag-out">Absent</span><?php endif; ?>
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
