<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();
$pdo = getPDO();

$msg = '';
// Handle Add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        try {
            $pdo->prepare('INSERT INTO employees (emp_id,full_name,email,department_id,position,monthly_salary,work_start_time,grace_period_minutes,pin) VALUES (?,?,?,?,?,?,?,?,?)')->execute([
                trim($_POST['emp_id']), trim($_POST['full_name']), trim($_POST['email']),
                (int)$_POST['department_id'], trim($_POST['position']),
                (float)$_POST['monthly_salary'], $_POST['work_start_time'],
                (int)$_POST['grace_period_minutes'], trim($_POST['pin'])
            ]);
            $msg = 'success:Employee added successfully.';
        } catch(PDOException $e) { $msg = 'error:Could not add employee. ID or Email may already exist.'; }
    } elseif ($_POST['action'] === 'toggle') {
        $id = (int)$_POST['emp_id_toggle'];
        $current = $pdo->prepare('SELECT status FROM employees WHERE id=?'); $current->execute([$id]);
        $s = $current->fetchColumn();
        $pdo->prepare('UPDATE employees SET status=? WHERE id=?')->execute([$s==='active'?'inactive':'active', $id]);
        $msg = 'success:Employee status updated.';
    } elseif ($_POST['action'] === 'update_salary') {
        $pdo->prepare('UPDATE employees SET monthly_salary=? WHERE id=?')->execute([(float)$_POST['salary'], (int)$_POST['eid']]);
        $msg = 'success:Salary updated.';
    }
}

$employees = $pdo->query('SELECT e.*,d.name AS dept FROM employees e LEFT JOIN departments d ON d.id=e.department_id ORDER BY e.full_name')->fetchAll();
$departments = $pdo->query('SELECT * FROM departments ORDER BY name')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>E.A.S. — Employees</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Mono:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<?php include 'partials/nav.php'; ?>
<div class="page-wrap">
  <div class="page-header">
    <h1>Employees</h1>
    <button class="btn-primary" onclick="toggleModal('modal-add')">+ Add Employee</button>
  </div>

  <?php if($msg): $parts=explode(':',$msg,2); ?>
  <div class="alert alert-<?= $parts[0] ?>"><?= htmlspecialchars($parts[1]) ?></div>
  <?php endif; ?>

  <div class="card">
    <div class="table-wrap">
    <table>
      <thead><tr><th>Emp ID</th><th>Name</th><th>Department</th><th>Position</th><th>Salary (₦)</th><th>Work Start</th><th>Grace</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
      <?php foreach($employees as $e): ?>
      <tr>
        <td><span class="mono"><?= htmlspecialchars($e['emp_id']) ?></span></td>
        <td><?= htmlspecialchars($e['full_name']) ?></td>
        <td><?= htmlspecialchars($e['dept'] ?? '—') ?></td>
        <td><?= htmlspecialchars($e['position']) ?></td>
        <td>
          <form method="POST" style="display:flex;gap:6px;align-items:center;">
            <input type="hidden" name="action" value="update_salary">
            <input type="hidden" name="eid" value="<?= $e['id'] ?>">
            <input type="number" name="salary" value="<?= $e['monthly_salary'] ?>" class="mini-input" step="100">
            <button type="submit" class="btn-xs">Save</button>
          </form>
        </td>
        <td><?= htmlspecialchars($e['work_start_time']) ?></td>
        <td><?= $e['grace_period_minutes'] ?> min</td>
        <td><span class="tag <?= $e['status']==='active' ? 'tag-in' : 'tag-out' ?>"><?= ucfirst($e['status']) ?></span></td>
        <td>
          <form method="POST" style="display:inline;">
            <input type="hidden" name="action" value="toggle">
            <input type="hidden" name="emp_id_toggle" value="<?= $e['id'] ?>">
            <button type="submit" class="btn-xs btn-outline"><?= $e['status']==='active' ? 'Deactivate' : 'Activate' ?></button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  </div>
</div>

<!-- Add Employee Modal -->
<div id="modal-add" class="modal-overlay hidden" onclick="if(event.target===this)toggleModal('modal-add')">
  <div class="modal-box">
    <div class="modal-header"><h3>Add New Employee</h3><button onclick="toggleModal('modal-add')" class="modal-close">×</button></div>
    <form method="POST" class="modal-form">
      <input type="hidden" name="action" value="add">
      <div class="form-grid">
        <div class="field"><label>Employee ID *</label><input type="text" name="emp_id" required placeholder="EAS-006"></div>
        <div class="field"><label>Full Name *</label><input type="text" name="full_name" required></div>
        <div class="field"><label>Email *</label><input type="email" name="email" required></div>
        <div class="field"><label>Department</label>
          <select name="department_id">
            <option value="">— Select —</option>
            <?php foreach($departments as $d): ?><option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option><?php endforeach; ?>
          </select>
        </div>
        <div class="field"><label>Position</label><input type="text" name="position" placeholder="Software Engineer"></div>
        <div class="field"><label>Monthly Salary (₦)</label><input type="number" name="monthly_salary" value="150000" step="1000"></div>
        <div class="field"><label>Work Start Time</label><input type="time" name="work_start_time" value="08:00"></div>
        <div class="field"><label>Grace Period (minutes)</label><input type="number" name="grace_period_minutes" value="15" min="0" max="60"></div>
        <div class="field"><label>PIN (4–6 digits) *</label><input type="text" name="pin" required pattern="\d{4,6}" placeholder="1234" maxlength="6"></div>
      </div>
      <button type="submit" class="btn-submit">Add Employee</button>
    </form>
  </div>
</div>

<script>
function toggleModal(id){ document.getElementById(id).classList.toggle('hidden'); }
</script>
</body>
</html>
