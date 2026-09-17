<?php
// ============================================================
// E.A.S. — Penalty Engine
// ============================================================

/**
 * Given minutes late and employee salary, return penalty amount using active rules.
 */
function calculatePenalty(int $minutesLate, float $salary): float {
    if ($minutesLate <= 0) return 0.0;
    $pdo = getPDO();
    $stmt = $pdo->prepare('
        SELECT * FROM penalty_rules
        WHERE is_active = 1
          AND minutes_late_from <= ?
          AND (minutes_late_to IS NULL OR minutes_late_to >= ?)
        ORDER BY minutes_late_from DESC
        LIMIT 1
    ');
    $stmt->execute([$minutesLate, $minutesLate]);
    $rule = $stmt->fetch();
    if (!$rule) return 0.0;
    if ($rule['penalty_type'] === 'percentage') {
        return round(($rule['penalty_value'] / 100) * $salary, 2);
    }
    return (float) $rule['penalty_value'];
}

/**
 * How many minutes late is a given clock-in time vs expected start.
 */
function minutesLate(string $clockIn, string $workStart, int $gracePeriod): int {
    $ci = new DateTime($clockIn);
    $ws = new DateTime(date('Y-m-d') . ' ' . $workStart);
    $ws->modify("+{$gracePeriod} minutes");
    $diff = $ci->getTimestamp() - $ws->getTimestamp();
    return $diff > 0 ? (int) ceil($diff / 60) : 0;
}

/**
 * Recalculate & upsert the monthly deduction record for one employee.
 */
function recalcMonthlyDeduction(int $empId, int $month, int $year): void {
    $pdo = getPDO();
    // Fetch employee salary
    $emp = $pdo->prepare('SELECT monthly_salary FROM employees WHERE id = ?');
    $emp->execute([$empId]);
    $salary = (float)($emp->fetchColumn() ?: 0);

    $stmt = $pdo->prepare('
        SELECT COUNT(*) as late_days, SUM(minutes_late) as total_mins, SUM(penalty_amount) as total_penalty
        FROM attendance
        WHERE employee_id = ?
          AND MONTH(date) = ? AND YEAR(date) = ?
          AND minutes_late > 0
    ');
    $stmt->execute([$empId, $month, $year]);
    $row = $stmt->fetch();

    $totalPenalty  = (float)($row['total_penalty'] ?? 0);
    $salaryAfter   = max(0, $salary - $totalPenalty);

    $pdo->prepare('
        INSERT INTO monthly_deductions
            (employee_id, month, year, total_late_days, total_minutes_late, total_penalty, salary_before, salary_after)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
            total_late_days    = VALUES(total_late_days),
            total_minutes_late = VALUES(total_minutes_late),
            total_penalty      = VALUES(total_penalty),
            salary_before      = VALUES(salary_before),
            salary_after       = VALUES(salary_after)
    ')->execute([
        $empId, $month, $year,
        (int)($row['late_days'] ?? 0),
        (int)($row['total_mins'] ?? 0),
        $totalPenalty,
        $salary,
        $salaryAfter
    ]);
}
