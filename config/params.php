<?php

if (file_exists('params-local.php')) {
    return require 'params-local.php';
} else {
    return [
        'db-dsn' => 'mysql:host=localhost;dbname=test',
        'db-username' => 'test',
        'db-password' => 'test',
    ];
}