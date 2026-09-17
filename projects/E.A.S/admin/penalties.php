<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();
$pdo = getPDO();

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'add') {
        $pdo->prepare('INSERT INTO penalty_rules (rule_name,minutes_late_from,minutes_late_to,penalty_type,penalty_value,description) VALUES (?,?,?,?,?,?)')->execute([
            trim($_POST['rule_name']), (int)$_POST['from'], $_POST['to']!==''?(int)$_POST['to']:null,
            $_POST['penalty_type'], (float)$_POST['penalty_value'], trim($_POST['description'])
        ]);
        $msg = 'success:Rule added.';
    } elseif ($action === 'toggle') {
        $r = $pdo->prepare('SELECT is_active FROM penalty_rules WHERE id=?'); $r->execute([(int)$_POST['rid']]);
        $active = $r->fetchColumn();
        $pdo->prepare('UPDATE penalty_rules SET is_active=? WHERE id=?')->execute([$active?0:1, (int)$_POST['rid']]);
        $msg = 'success:Rule updated.';
    } elseif ($action === 'delete') {
        $pdo->prepare('DELETE FROM penalty_rules WHERE id=?')->execute([(int)$_POST['rid']]);
        $msg = 'success:Rule deleted.';
    }
}

$rules = $pdo->query('SELECT * FROM penalty_rules ORDER BY minutes_late_from')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>E.A.S. — Penalty Rules</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Mono:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<?php include 'partials/nav.php'; ?>
<div class="page-wrap">
  <div class="page-header">
    <h1>Penalty Rules</h1>
    <button class="btn-primary" onclick="toggleModal('modal-add')">+ Add Rule</button>
  </div>

  <?php if($msg): $p=explode(':',$msg,2); ?>
  <div class="alert alert-<?= $p[0] ?>"><?= htmlspecialchars($p[1]) ?></div>
  <?php endif; ?>

  <div class="card info-card">
    <p>📌 Rules are checked by how many minutes late a staff arrives <strong>after</strong> their grace period. The most specific matching rule is applied. Use "percentage" type to deduct a % of monthly salary.</p>
  </div>

  <div class="card">
    <div class="table-wrap">
    <table>
      <thead><tr><th>Rule Name</th><th>Mins Late From</th><th>Mins Late To</th><th>Type</th><th>Value</th><th>Description</th><th>Active</th><th>Actions</th></tr></thead>
      <tbody>
      <?php foreach($rules as $r): ?>
      <tr class="<?= !$r['is_active'] ? 'row-disabled' : '' ?>">
        <td><strong><?= htmlspecialchars($r['rule_name']) ?></strong></td>
        <td><?= $r['minutes_late_from'] ?> min</td>
        <td><?= $r['minutes_late_to'] ? $r['minutes_late_to'].' min' : '∞' ?></td>
        <td><span class="tag <?= $r['penalty_type']==='fixed'?'tag-in':'tag-done' ?>"><?= ucfirst($r['penalty_type']) ?></span></td>
        <td><?= $r['penalty_type']==='fixed' ? '₦'.number_format($r['penalty_value']) : $r['penalty_value'].'%' ?></td>
        <td><?= htmlspecialchars($r['description']) ?></td>
        <td><?= $r['is_active'] ? '<span class="tag tag-in">Yes</span>' : '<span class="tag tag-out">No</span>' ?></td>
        <td style="display:flex;gap:6px;">
          <form method="POST"><input type="hidden" name="action" value="toggle"><input type="hidden" name="rid" value="<?= $r['id'] ?>">
            <button class="btn-xs"><?= $r['is_active']?'Disable':'Enable' ?></button>
          </form>
          <form method="POST" onsubmit="return confirm('Delete this rule?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="rid" value="<?= $r['id'] ?>">
            <button class="btn-xs btn-danger">Del</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  </div>
</div>

<div id="modal-add" class="modal-overlay hidden" onclick="if(event.target===this)toggleModal('modal-add')">
  <div class="modal-box">
    <div class="modal-header"><h3>Add Penalty Rule</h3><button onclick="toggleModal('modal-add')" class="modal-close">×</button></div>
    <form method="POST" class="modal-form">
      <input type="hidden" name="action" value="add">
      <div class="form-grid">
        <div class="field"><label>Rule Name *</label><input type="text" name="rule_name" required placeholder="Severe Late"></div>
        <div class="field"><label>Minutes Late From *</label><input type="number" name="from" required min="1" placeholder="61"></div>
        <div class="field"><label>Minutes Late To (blank = unlimited)</label><input type="number" name="to" placeholder="120"></div>
        <div class="field"><label>Penalty Type</label>
          <select name="penalty_type">
            <option value="fixed">Fixed Amount (₦)</option>
            <option value="percentage">Percentage of Salary (%)</option>
          </select>
        </div>
        <div class="field"><label>Value</label><input type="number" name="penalty_value" step="0.01" required placeholder="500 or 1.5"></div>
        <div class="field" style="grid-column:span 2"><label>Description</label><textarea name="description" rows="2" placeholder="Brief description of this rule"></textarea></div>
      </div>
      <button type="submit" class="btn-submit">Add Rule</button>
    </form>
  </div>
</div>
<script>function toggleModal(id){document.getElementById(id).classList.toggle('hidden');}</script>
</body>
</html>
