<?php

$params = require(__DIR__ . '/../config/params.php');

$dbOpt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

$pdo = new PDO($params['db-dsn'], $params['db-username'], $params['db-password'], $dbOpt);

$sql ="CREATE TABLE test_messages (
     id INT(11) AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(50) NOT NULL,
     email VARCHAR(250) NOT NULL,
     text TEXT NOT NULL,
     created_at INT(11) NOT NULL,
     is_approved BOOLEAN DEFAULT FALSE,
     is_edited BOOLEAN DEFAULT FALSE);" ;

$pdo->exec($sql);