<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/penalty.php';
requireAdmin();
$pdo = getPDO();

$month = (int)($_GET['month'] ?? date('n'));
$year  = (int)($_GET['year']  ?? date('Y'));
$msg   = '';

// Finalize / Recalculate
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'recalc') {
        $emps = $pdo->query('SELECT id FROM employees WHERE status="active"')->fetchAll();
        foreach ($emps as $e) recalcMonthlyDeduction($e['id'], $month, $year);
        $msg = 'success:Deductions recalculated for all employees.';
    } elseif ($action === 'finalize') {
        $pdo->prepare('UPDATE monthly_deductions SET finalized=1, finalized_at=NOW() WHERE month=? AND year=?')->execute([$month,$year]);
        $msg = 'success:Report finalized.';
    }
}

// Get deduction summary
$stmt = $pdo->prepare('
    SELECT md.*, e.full_name, e.emp_id AS eid, d.name AS dept
    FROM monthly_deductions md
    JOIN employees e ON e.id = md.employee_id
    LEFT JOIN departments d ON d.id = e.department_id
    WHERE md.month=? AND md.year=?
    ORDER BY md.total_penalty DESC
');
$stmt->execute([$month, $year]);
$deductions = $stmt->fetchAll();

// Employees with zero penalties this month
$stmt2 = $pdo->prepare('
    SELECT e.id, e.emp_id AS eid, e.full_name, e.monthly_salary, d.name AS dept
    FROM employees e
    LEFT JOIN departments d ON d.id=e.department_id
    WHERE e.status="active"
      AND e.id NOT IN (SELECT employee_id FROM monthly_deductions WHERE month=? AND year=?)
');
$stmt2->execute([$month, $year]);
$noPenalty = $stmt2->fetchAll();

$months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
$isFinalized = !empty($deductions) && $deductions[0]['finalized'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>E.A.S. — Reports</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Mono:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<?php include 'partials/nav.php'; ?>
<div class="page-wrap">
  <div class="page-header">
    <h1>Monthly Deduction Reports</h1>
    <div style="display:flex;gap:8px;">
      <form method="POST"><input type="hidden" name="action" value="recalc"><input type="hidden" name="month" value="<?=$month?>"><input type="hidden" name="year" value="<?=$year?>">
        <button class="btn-outline-link">↺ Recalculate</button>
      </form>
      <?php if(!$isFinalized && !empty($deductions)): ?>
      <form method="POST" onsubmit="return confirm('Finalize this report? This marks it as processed.')"><input type="hidden" name="action" value="finalize"><input type="hidden" name="month" value="<?=$month?>"><input type="hidden" name="year" value="<?=$year?>">
        <button class="btn-primary">✓ Finalize Report</button>
      </form>
      <?php endif; ?>
    </div>
  </div>

  <?php if($msg): $p=explode(':',$msg,2); ?><div class="alert alert-<?=$p[0]?>"><?=htmlspecialchars($p[1])?></div><?php endif; ?>

  <!-- Month selector -->
  <div class="card filter-bar">
    <form method="GET" style="display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap;">
      <div class="field"><label>Month</label>
        <select name="month">
          <?php for($m=1;$m<=12;$m++): ?><option value="<?=$m?>" <?=$m===$month?'selected':''?>><?=$months[$m-1]?></option><?php endfor; ?>
        </select>
      </div>
      <div class="field"><label>Year</label>
        <select name="year">
          <?php for($y=date('Y');$y>=date('Y')-3;$y--): ?><option value="<?=$y?>" <?=$y===$year?'selected':''?>><?=$y?></option><?php endfor; ?>
        </select>
      </div>
      <button type="submit" class="btn-primary">View Report</button>
    </form>
  </div>

  <?php if($isFinalized): ?><div class="alert alert-info">✅ This report has been finalized and locked.</div><?php endif; ?>

  <?php if(empty($deductions) && empty($noPenalty)): ?>
    <div class="card"><p class="empty">No data for <?=$months[$month-1].' '.$year?>. Click "Recalculate" to generate.</p></div>
  <?php else: ?>

  <!-- Summary cards -->
  <?php
  $totalPenalties = array_sum(array_column($deductions, 'total_penalty'));
  $totalLateDays  = array_sum(array_column($deductions, 'total_late_days'));
  ?>
  <div class="stats-grid">
    <div class="stat-card"><div class="stat-icon s-blue">📅</div><div class="stat-val"><?=$months[$month-1].' '.$year?></div><div class="stat-label">Report Period</div></div>
    <div class="stat-card"><div class="stat-icon s-yellow">⚠️</div><div class="stat-val"><?=count($deductions)?></div><div class="stat-label">Staff with Penalties</div></div>
    <div class="stat-card"><div class="stat-icon s-red">₦</div><div class="stat-val">₦<?=number_format($totalPenalties)?></div><div class="stat-label">Total Deductions</div></div>
    <div class="stat-card"><div class="stat-icon s-green">✅</div><div class="stat-val"><?=count($noPenalty)?></div><div class="stat-label">Staff, No Penalty</div></div>
  </div>

  <!-- Staff with penalties -->
  <div class="card">
    <div class="card-header"><h2>⚠ Staff with Late Penalties</h2></div>
    <div class="table-wrap">
    <table>
      <thead><tr><th>Emp ID</th><th>Name</th><th>Dept</th><th>Late Days</th><th>Total Mins Late</th><th>Gross Salary (₦)</th><th>Total Penalty (₦)</th><th>Net Salary (₦)</th><th>Status</th></tr></thead>
      <tbody>
      <?php if(empty($deductions)): ?><tr><td colspan="9" class="empty">None this period.</td></tr>
      <?php else: foreach($deductions as $d): ?>
      <tr>
        <td><span class="mono"><?=htmlspecialchars($d['eid'])?></span></td>
        <td><?=htmlspecialchars($d['full_name'])?></td>
        <td><?=htmlspecialchars($d['dept']??'—')?></td>
        <td><span class="late-badge"><?=$d['total_late_days']?> days</span></td>
        <td><?=number_format($d['total_minutes_late'])?> min</td>
        <td>₦<?=number_format($d['salary_before'])?></td>
        <td><span class="penalty-tag">₦<?=number_format($d['total_penalty'])?></span></td>
        <td><strong class="net-salary">₦<?=number_format($d['salary_after'])?></strong></td>
        <td><?=$d['finalized'] ? '<span class="tag tag-done">Finalized</span>' : '<span class="tag tag-in">Pending</span>'?></td>
      </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
    </div>
  </div>

  <!-- Staff with no penalty -->
  <div class="card">
    <div class="card-header"><h2>✅ Staff with No Penalties</h2></div>
    <div class="table-wrap">
    <table>
      <thead><tr><th>Emp ID</th><th>Name</th><th>Dept</th><th>Gross Salary (₦)</th><th>Deduction</th><th>Net Salary (₦)</th></tr></thead>
      <tbody>
      <?php foreach($noPenalty as $n): ?>
      <tr>
        <td><span class="mono"><?=htmlspecialchars($n['eid'])?></span></td>
        <td><?=htmlspecialchars($n['full_name'])?></td>
        <td><?=htmlspecialchars($n['dept']??'—')?></td>
        <td>₦<?=number_format($n['monthly_salary'])?></td>
        <td>—</td>
        <td><strong class="net-salary">₦<?=number_format($n['monthly_salary'])?></strong></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  </div>

  <!-- Per-employee detail drilldown -->
  <div class="card">
    <div class="card-header"><h2>📋 Late Attendance Detail — <?=$months[$month-1].' '.$year?></h2></div>
    <?php foreach($deductions as $d):
      $detail = $pdo->prepare('SELECT * FROM attendance WHERE employee_id=? AND MONTH(date)=? AND YEAR(date)=? AND minutes_late>0 ORDER BY date');
      $detail->execute([$d['employee_id'], $month, $year]);
      $rows = $detail->fetchAll();
    ?>
    <div class="drilldown-section">
      <div class="drilldown-header"><?=htmlspecialchars($d['full_name'])?> <span class="mono">(<?=htmlspecialchars($d['eid'])?>)</span></div>
      <div class="table-wrap">
      <table>
        <thead><tr><th>Date</th><th>Clock In</th><th>Mins Late</th><th>Penalty (₦)</th></tr></thead>
        <tbody>
        <?php foreach($rows as $row): ?>
        <tr>
          <td><?=date('D, M j', strtotime($row['date']))?></td>
          <td><?=date('H:i', strtotime($row['clock_in']))?></td>
          <td><span class="late-badge"><?=$row['minutes_late']?> min</span></td>
          <td><span class="penalty-tag">₦<?=number_format($row['penalty_amount'])?></span></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>
</body>
</html>
