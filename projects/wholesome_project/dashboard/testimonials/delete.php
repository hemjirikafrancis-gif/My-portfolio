<?php
require_once __DIR__ . '/../../auth.php';
include __DIR__ . '/../../db.php';
$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
  $row = $conn->query("SELECT image FROM testimonials WHERE id = " . $id)->fetch_assoc();
  if ($row && !empty($row['image']) && strpos($row['image'], 'uploads/') === 0) {
    @unlink(__DIR__ . '/../../' . $row['image']);
  }
  $stmt = $conn->prepare("DELETE FROM testimonials WHERE id = ?");
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $stmt->close();
}
$conn->close();
header('Location: index.php?deleted=1');
exit;
