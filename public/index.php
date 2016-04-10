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

session_start();

$userComponent = \source\core\components\UserComponent::getInstance();
$userComponent->checkUserSession();

$router = new RouteCollector();

$router->get('/', [\source\controllers\IndexController::className(), 'actionIndex']);
$router->post('/create', [\source\controllers\IndexController::className(), 'actionCreate']);
$router->post('/validate/{id}?', [\source\controllers\IndexController::className(), 'actionValidate']);
$router->post('/edit/{id}', [\source\controllers\IndexController::className(), 'actionEdit']);
$router->patch('/set-status/{id}/{status}', [\source\controllers\IndexController::className(), 'actionSetStatus']);

$router->get('/login', [\source\controllers\LoginController::className(), 'actionIndex']);
$router->post('/login/validate', [\source\controllers\LoginController::className(), 'actionValidate']);
$router->post('/login', [\source\controllers\LoginController::className(), 'actionLogin']);
$router->get('/logout', [\source\controllers\LoginController::className(), 'actionLogout']);

$dispatcher =  new Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

echo $response;