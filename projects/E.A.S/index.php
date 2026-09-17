<?php
// E.A.S. — Staff Clock In/Out Terminal
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/penalty.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E.A.S. — Attendance Terminal</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/terminal.css">
</head>
<body>
<div class="bg-rings">
  <div class="ring r1"></div>
  <div class="ring r2"></div>
  <div class="ring r3"></div>
</div>

<header class="top-bar">
  <div class="brand">
    <span class="brand-icon">⏱</span>
    <span class="brand-name">E.A.S.</span>
    <span class="brand-sub">Employee Attendance System</span>
  </div>
  <div class="live-clock">
    <div id="live-time" class="clock-time">--:--:--</div>
    <div id="live-date" class="clock-date">---</div>
  </div>
  <a href="admin/login.php" class="admin-link">Admin Panel →</a>
</header>

<main class="terminal-wrap">
  <!-- Step 1: Enter Employee ID -->
  <section class="panel" id="step-id">
    <div class="panel-header">
      <div class="step-badge">01</div>
      <h2>Identify Yourself</h2>
      <p>Enter your Employee ID to continue</p>
    </div>
    <div class="panel-body">
      <input type="text" id="emp-id-input" class="big-input" placeholder="e.g. EAS-001" maxlength="20" autocomplete="off" spellcheck="false">
      <div id="emp-error" class="msg-error hidden"></div>
      <button class="btn-primary" onclick="lookupEmployee()">Continue <span class="arrow">→</span></button>
    </div>
  </section>

  <!-- Step 2: PIN Entry -->
  <section class="panel hidden" id="step-pin">
    <div class="panel-header">
      <div class="step-badge">02</div>
      <h2>Enter PIN</h2>
      <p id="pin-greeting">Welcome back, <strong id="emp-name-display"></strong></p>
    </div>
    <div class="panel-body">
      <div id="pin-display" class="pin-dots">
        <span></span><span></span><span></span><span></span><span></span><span></span>
      </div>
      <div class="numpad">
        <?php for($i=1;$i<=9;$i++): ?>
        <button class="num-btn" onclick="pinPress(<?= $i ?>)"><?= $i ?></button>
        <?php endfor; ?>
        <button class="num-btn num-clear" onclick="pinClear()">⌫</button>
        <button class="num-btn" onclick="pinPress(0)">0</button>
        <button class="num-btn num-go" onclick="submitPin()">✓</button>
      </div>
      <div id="pin-error" class="msg-error hidden"></div>
      <button class="btn-ghost" onclick="goBack()">← Back</button>
    </div>
  </section>

  <!-- Step 3: Action (Clock In / Clock Out) -->
  <section class="panel hidden" id="step-action">
    <div class="panel-header">
      <div class="step-badge">03</div>
      <h2 id="action-heading">What would you like to do?</h2>
      <div class="emp-card">
        <div class="emp-avatar" id="action-avatar"></div>
        <div class="emp-info">
          <strong id="action-name"></strong>
          <span id="action-dept"></span>
        </div>
        <div id="action-status-badge" class="status-badge"></div>
      </div>
    </div>
    <div class="panel-body">
      <div id="today-record" class="today-card hidden"></div>
      <div class="action-buttons">
        <button class="btn-clockin" id="btn-clockin" onclick="doClockIn()">
          <span class="btn-icon">🟢</span> Clock In
        </button>
        <button class="btn-clockout" id="btn-clockout" onclick="doClockOut()">
          <span class="btn-icon">🔴</span> Clock Out
        </button>
      </div>
      <div id="action-msg" class="msg-success hidden"></div>
      <button class="btn-ghost mt" onclick="resetTerminal()">← New Session</button>
    </div>
  </section>

  <!-- Step 4: Result -->
  <section class="panel hidden" id="step-result">
    <div class="result-icon" id="result-icon">✅</div>
    <h2 id="result-title">Done!</h2>
    <div id="result-body" class="result-body"></div>
    <div class="countdown-bar"><div id="countdown-fill" class="countdown-fill"></div></div>
    <p class="countdown-label">Returning to terminal in <span id="cdown">10</span>s</p>
    <button class="btn-ghost" onclick="resetTerminal()">← New Session Now</button>
  </section>
</main>

<div id="loader" class="loader-overlay hidden"><div class="spinner"></div></div>

<script>
// =====================================================
// State
// =====================================================
let currentEmp = null;
let pinBuffer  = '';
const MAX_PIN  = 6;

// =====================================================
// Live Clock
// =====================================================
function updateClock() {
  const now  = new Date();
  const time = now.toLocaleTimeString('en-GB');
  const date = now.toLocaleDateString('en-GB', {weekday:'long',year:'numeric',month:'long',day:'numeric'});
  document.getElementById('live-time').textContent = time;
  document.getElementById('live-date').textContent = date;
}
setInterval(updateClock, 1000);
updateClock();

// =====================================================
// Navigation helpers
// =====================================================
function showPanel(id) {
  document.querySelectorAll('.panel').forEach(p => p.classList.add('hidden'));
  document.getElementById(id).classList.remove('hidden');
  document.getElementById(id).classList.add('fade-in');
}

function showLoader(v) {
  document.getElementById('loader').classList.toggle('hidden', !v);
}

function goBack() {
  pinBuffer = '';
  renderPinDots();
  showPanel('step-id');
}

function resetTerminal() {
  currentEmp = null;
  pinBuffer  = '';
  document.getElementById('emp-id-input').value = '';
  document.getElementById('emp-error').classList.add('hidden');
  document.getElementById('pin-error').classList.add('hidden');
  showPanel('step-id');
  document.getElementById('emp-id-input').focus();
}

// =====================================================
// Step 1: Employee Lookup
// =====================================================
async function lookupEmployee() {
  const empId = document.getElementById('emp-id-input').value.trim();
  if (!empId) { showError('emp-error', 'Please enter your Employee ID.'); return; }
  showLoader(true);
  try {
    const res  = await fetch('api/lookup.php', {method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({emp_id: empId})});
    const data = await res.json();
    showLoader(false);
    if (data.success) {
      currentEmp = data.employee;
      document.getElementById('emp-name-display').textContent = currentEmp.full_name;
      renderPinDots();
      showPanel('step-pin');
    } else {
      showError('emp-error', data.message || 'Employee not found.');
    }
  } catch(e) { showLoader(false); showError('emp-error', 'Network error. Try again.'); }
}

document.getElementById('emp-id-input').addEventListener('keydown', e => { if (e.key === 'Enter') lookupEmployee(); });

// =====================================================
// Step 2: PIN
// =====================================================
function pinPress(n) {
  if (pinBuffer.length >= MAX_PIN) return;
  pinBuffer += n;
  renderPinDots();
  if (pinBuffer.length === MAX_PIN) setTimeout(submitPin, 200);
}

function pinClear() {
  pinBuffer = pinBuffer.slice(0, -1);
  renderPinDots();
}

function renderPinDots() {
  const dots = document.querySelectorAll('#pin-display span');
  dots.forEach((d, i) => {
    d.className = i < pinBuffer.length ? 'filled' : '';
  });
}

async function submitPin() {
  if (pinBuffer.length < 1) { showError('pin-error', 'Enter your PIN.'); return; }
  showLoader(true);
  try {
    const res  = await fetch('api/verify_pin.php', {method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({emp_id: currentEmp.id, pin: pinBuffer})});
    const data = await res.json();
    showLoader(false);
    if (data.success) {
      loadActionPanel(data.attendance);
    } else {
      pinBuffer = '';
      renderPinDots();
      showError('pin-error', 'Incorrect PIN. Try again.');
    }
  } catch(e) { showLoader(false); showError('pin-error', 'Network error.'); }
}

// =====================================================
// Step 3: Action Panel
// =====================================================
function loadActionPanel(attendance) {
  document.getElementById('action-name').textContent = currentEmp.full_name;
  document.getElementById('action-dept').textContent = currentEmp.department + ' · ' + currentEmp.position;
  const av = document.getElementById('action-avatar');
  av.textContent = currentEmp.full_name.split(' ').map(w=>w[0]).join('').substring(0,2).toUpperCase();

  const badge  = document.getElementById('action-status-badge');
  const ci     = document.getElementById('btn-clockin');
  const co     = document.getElementById('btn-clockout');
  const todayCard = document.getElementById('today-record');

  if (attendance && attendance.clock_in) {
    badge.textContent = 'Clocked In';
    badge.className   = 'status-badge badge-in';
    ci.disabled = true;
    co.disabled = false;
    todayCard.classList.remove('hidden');
    todayCard.innerHTML = `<div class="today-row"><span>Clocked In:</span><strong>${formatTime(attendance.clock_in)}</strong></div>` +
      (attendance.minutes_late > 0 ? `<div class="today-row late"><span>⚠ Late by:</span><strong>${attendance.minutes_late} min — Penalty: ₦${Number(attendance.penalty_amount).toLocaleString()}</strong></div>` : `<div class="today-row"><span>Status:</span><strong class="on-time">✅ On Time</strong></div>`);
  } else if (attendance && attendance.clock_out) {
    badge.textContent = 'Completed';
    badge.className   = 'status-badge badge-done';
    ci.disabled = true;
    co.disabled = true;
    todayCard.classList.remove('hidden');
    todayCard.innerHTML = `<div class="today-row"><span>Clocked In:</span><strong>${formatTime(attendance.clock_in)}</strong></div><div class="today-row"><span>Clocked Out:</span><strong>${formatTime(attendance.clock_out)}</strong></div>`;
  } else {
    badge.textContent = 'Not Clocked In';
    badge.className   = 'status-badge badge-out';
    ci.disabled = false;
    co.disabled = true;
    todayCard.classList.add('hidden');
  }
  showPanel('step-action');
}

async function doClockIn() {
  showLoader(true);
  try {
    const res  = await fetch('api/clock_in.php', {method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({emp_id: currentEmp.id})});
    const data = await res.json();
    showLoader(false);
    if (data.success) showResult(data);
    else showError('action-msg', data.message);
  } catch(e) { showLoader(false); showError('action-msg', 'Error clocking in.'); }
}

async function doClockOut() {
  showLoader(true);
  try {
    const res  = await fetch('api/clock_out.php', {method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({emp_id: currentEmp.id})});
    const data = await res.json();
    showLoader(false);
    if (data.success) showResult(data);
    else showError('action-msg', data.message);
  } catch(e) { showLoader(false); showError('action-msg', 'Error clocking out.'); }
}

// =====================================================
// Step 4: Result
// =====================================================
function showResult(data) {
  document.getElementById('result-icon').textContent = data.type === 'clock_in' ? '🟢' : '🔴';
  document.getElementById('result-title').textContent = data.type === 'clock_in' ? 'Clocked In!' : 'Clocked Out!';
  let body = `<div class="result-row"><span>Name:</span><strong>${currentEmp.full_name}</strong></div>`;
  body += `<div class="result-row"><span>Time:</span><strong>${data.time}</strong></div>`;
  if (data.type === 'clock_in') {
    if (data.minutes_late > 0) {
      body += `<div class="result-row penalty"><span>⚠ Arrived Late By:</span><strong>${data.minutes_late} minutes</strong></div>`;
      body += `<div class="result-row penalty"><span>Penalty Applied:</span><strong>₦${Number(data.penalty).toLocaleString()}</strong></div>`;
    } else {
      body += `<div class="result-row"><span>Status:</span><strong class="on-time">✅ On Time</strong></div>`;
    }
  } else {
    body += `<div class="result-row"><span>Duration:</span><strong>${data.duration}</strong></div>`;
  }
  document.getElementById('result-body').innerHTML = body;
  showPanel('step-result');
  startCountdown(10);
}

function startCountdown(sec) {
  const fill  = document.getElementById('countdown-fill');
  const label = document.getElementById('cdown');
  let remaining = sec;
  fill.style.width = '100%';
  const iv = setInterval(() => {
    remaining--;
    label.textContent = remaining;
    fill.style.width = (remaining / sec * 100) + '%';
    if (remaining <= 0) { clearInterval(iv); resetTerminal(); }
  }, 1000);
}

// =====================================================
// Utilities
// =====================================================
function showError(id, msg) {
  const el = document.getElementById(id);
  el.textContent = msg;
  el.classList.remove('hidden');
  setTimeout(() => el.classList.add('hidden'), 4000);
}

function formatTime(dt) {
  if (!dt) return '—';
  return new Date(dt).toLocaleTimeString('en-GB', {hour:'2-digit', minute:'2-digit'});
}
</script>
</body>
</html>
