<?php

/**
 * @var \source\core\view\View $this
 * @var string $username
 */

$username = $this->getField('username');
?>

<!doctype html>

<head>
    <meta charset="utf-8">
    <title>Messages</title>
</head>

<body>
<header>
    <?php if (!empty($username)): ?>
        <p>Hello, <?= $username ?></p>
    <?php else: ?>
        <p>Hello, guest!</p>
    <?php endif ?>
</header>