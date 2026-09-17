<?php
/**
 * Global <head> + opening <body>
 * Included at the top of every page.
 */
$base = ''; // relative path prefix, adjust per page depth if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo isset($pageTitle) ? $pageTitle . ' — F.H' : 'F.H — Web Developer'; ?></title>
<meta name="description" content="Francis (F.H) is a web developer working with HTML, CSS, JavaScript and PHP — building and fixing real websites for real clients.">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

<!-- Styles -->
<link rel="stylesheet" href="<?php echo $base; ?>css/style.css">
</head>
<body>
