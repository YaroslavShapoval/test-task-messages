<?php

namespace source\controllers;

use source\core\BaseController;
use source\core\components\UserComponent;
use source\models\Message;

class IndexController extends BaseController
{
    public function actionIndex()
    {
        $userComponent = UserComponent::getInstance();

        $afterCreate = false;

        if (!empty($_SESSION['after_create'])) {
            $afterCreate = true;
            unset($_SESSION['after_create']);
        }

        $conditions = [];

        if ($userComponent->isGuest()) {
            // Do not display unapproved or declined messages for guests
            $conditions['status'] = Message::$statuses['APPROVED'];
        } else {
            // Do not display declined messages
            $conditions = [
                'status = ? OR status = ?', Message::$statuses['UNAPPROVED'], Message::$statuses['APPROVED'],
            ];
        }

        return $this->render('messages/index', [
            'after_create' => $afterCreate,

            'list' => Message::find('all', [
                'conditions' => $conditions,
                'order' => 'created_at DESC',
            ]),
        ]);
    }

    public function actionCreate()
    {
        $attributes = $_POST;
        $message = new Message($attributes);

        if ($message->save()) {
            $_SESSION['after_create'] = true;
            return '';
        } else {
            return json_encode($message->errors->to_array());
        }
    }

    public function actionEdit($id)
    {
        $userComponent = UserComponent::getInstance();

        if ($userComponent->isGuest()) {
            return '';
        }

        $attributes = $_POST;

        $message = $this->findMessageById($id);
        $message->set_attributes($attributes);
        $message->is_edited = true;

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

    public function actionSetStatus($id, $status = 0)
    {
        $userComponent = UserComponent::getInstance();

        if ($userComponent->isGuest()) {
            return '';
        }

        $message = $this->findMessageById($id);
        $message->status = $status;

        if ($message->save()) {
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