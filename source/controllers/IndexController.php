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

        if ($message->save()) {
            return '';
        } else {
            return json_encode($message->errors->to_array());
        }
    }

    public function actionEdit($id)
    {
        $attributes = $_POST;

        $message = $this->findMessageById($id);
        $message->set_attributes($attributes);

        if ($message->save()) {
            return '';
        } else {
            return json_encode($message->errors->to_array());
        }
    }

    public function actionValidate($id = null)
    {
        $attributes = $_POST;

        if ($id === null) {
            $message = new Message($attributes);
        } else {
            $message = $this->findMessageById($id);
            $message->set_attributes($attributes);
        }

        if ($message->is_valid()) {
            return '';
        } else {
            return json_encode($message->errors->to_array());
        }
    }

    /**
     * @param $id
     * @return Message
     * @throws \ActiveRecord\RecordNotFound
     */
    private function findMessageById($id)
    {
        return Message::find($id);
    }
}