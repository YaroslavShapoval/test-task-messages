<?php

error_reporting(-1);
ini_set('display_errors', 'ON');

require_once __DIR__.'/../vendor/autoload.php';

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$params = require(__DIR__ . '/../config/params.php');

$cfg = ActiveRecord\Config::instance();
$cfg->set_model_directory(__DIR__.'/../source/models');
$cfg->set_connections([
    'development' => $params['db'],
]);

$router = new RouteCollector();

$router->get('/', [\source\controllers\IndexController::className(), 'actionIndex']);
$router->post('/create', [\source\controllers\IndexController::className(), 'actionCreate']);
$router->post('/validate', [\source\controllers\IndexController::className(), 'actionValidate']);

$dispatcher =  new Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

echo $response;