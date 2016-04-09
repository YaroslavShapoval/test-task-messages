<?php

namespace source\controllers;

use source\core\BaseController;
use source\models\Message;

class IndexController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('messages/index', [
            'list' => Message::find('all', [
                'order' => 'created_at DESC',
            ]),
        ]);
    }

    public function actionCreate()
    {
        $attributes = $_POST;
        $message = new Message($attributes);
        $message->save();
    }
}