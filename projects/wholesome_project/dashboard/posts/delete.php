<?php
require_once __DIR__ . '/../../auth.php';
include __DIR__ . '/../../db.php';
$id = (int)($_GET['id'] ?? 0);
$s = $conn->prepare('DELETE FROM blogs WHERE id=?');
$s->bind_param('i', $id);
$s->execute();
header('Location: index.php?deleted=1');
exit;
