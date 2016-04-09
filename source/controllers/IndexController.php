<?php

namespace source\controllers;

use source\core\BaseController;

class IndexController extends BaseController
{
    public function actionIndex()
    {
        return "Hello, world!";
    }

    public function actionSomeTestThing()
    {
        return "Hello from somewhere!";
    }
}