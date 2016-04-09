<?php

require_once __DIR__.'/../vendor/autoload.php';

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
use Pimple\Container;

$params = require(__DIR__ . '/../config/params.php');

$container = new Container();

$dbOpt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$container['db'] = new PDO($params['db-dsn'], $params['db-username'], $params['db-password'], $dbOpt);

$router = new RouteCollector();

$router->get('/', [\source\controllers\IndexController::className(), 'actionIndex']);

$dispatcher =  new Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

echo $response;