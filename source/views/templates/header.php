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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
          crossorigin="anonymous">

    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
<header>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">Test</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <?php if (!empty($username)): ?>
                    <li class="navbar-text">Hello, <?= $username ?>!</li>
                    <li><a href="/logout">Log out</a></li>
                <?php else: ?>
                    <li class="navbar-text">Hello, guest!</li>
                    <li><a href="/login">Log in</a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
</header>