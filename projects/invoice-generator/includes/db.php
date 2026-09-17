<?php
/**
 * Database Connection
 * Change DB_USER / DB_PASS to match your MySQL credentials.
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');      // ← your MySQL username
define('DB_PASS', '');          // ← your MySQL password (blank for XAMPP default)
define('DB_NAME', 'invoice_generator');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die('
    <div style="font-family:sans-serif;max-width:540px;margin:60px auto;padding:28px 32px;
                background:#fff;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.1);
                border-left:4px solid #dc2626;">
        <h2 style="color:#dc2626;margin:0 0 12px">Database Connection Failed</h2>
        <p style="color:#374151;margin:0 0 16px"><strong>Error:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>
        <hr style="border:none;border-top:1px solid #e5e7eb;margin:16px 0">
        <p style="color:#6b7280;font-size:14px;margin:0 0 8px">To fix this, check the following in <code>includes/db.php</code>:</p>
        <ul style="color:#6b7280;font-size:14px;margin:0;padding-left:20px;line-height:2">
            <li><strong>DB_USER</strong> — your MySQL username (usually <code>root</code>)</li>
            <li><strong>DB_PASS</strong> — your MySQL password (blank for XAMPP)</li>
            <li><strong>DB_NAME</strong> — must be <code>invoice_generator</code></li>
            <li>Run <code>setup.sql</code> in phpMyAdmin to create the database &amp; tables</li>
        </ul>
    </div>');
}
