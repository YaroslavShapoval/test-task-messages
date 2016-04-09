<?php

if (file_exists(__DIR__.'/params-local.php')) {
    # Local db connection settings
    return require 'params-local.php';
} else {
    # Heroku db connection settings
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    return [
        'db' => 'mysql://'.$url["user"].':'.$url["pass"].'@'.$url["host"].'/'.substr($url["path"],1),
    ];
}