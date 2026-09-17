<?php
require_once 'auth.php';
include 'db.php';
$id = (int)($_GET['id'] ?? 0);
$s = $conn->prepare('DELETE FROM blogs WHERE id=?');
$s->bind_param('i', $id);
$s->execute();
header('Location: dashboard/posts/index.php');
exit;
