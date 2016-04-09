<?php

if (file_exists(__DIR__.'/params-local.php')) {
    # Local db connection settings
    return require 'params-local.php';
} else {
    # Heroku db connection settings
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    return [
        'db-dsn' => 'mysql:host='.$url["host"].';dbname='.substr($url["path"],1),
        'db-username' => $url["user"],
        'db-password' => $url["pass"],
    ];
}